/****
 * core of the application for mvc concept
 * */
const { parse } = require("querystring"),
  fastapp = require("./loader"),
  eventsLists = require("../controllers/eventsLists");
const options = {
  key: fastapp.fs.readFileSync("/home/apphost/ssl.key"),
  cert: fastapp.fs.readFileSync("/home/apphost/ssl.cert"),
  ca: fastapp.fs.readFileSync("/home/apphost/ssl.ca")
};
fastapp.runServer = function() {
  fastapp.https
    .createServer(options, function(req, res) {
      requestProcessor(req, function(data) {
        if (typeof data.status != "undefined") {
          res.writeHead(200, {
            "Content-Type": fastapp.config.contentType,
            "Access-Control-Allow-Origin": "*"
          });
          res.end(JSON.stringify(data));
        }
      });
    })
    .listen(fastapp.config.port, fastapp.config.host);
  /*****************************
   * init socket connection
   */
  fastapp.router.on("*", function(sock, args, next) {
    var triggerFunction = args.shift(),
      dataObject = args.shift();
    console.log(args);
    if (typeof eventsLists.eventsMapper[triggerFunction] == "function") {
      eventsLists.eventsMapper[triggerFunction](dataObject, function(
        type,
        emitEvent,
        dataOutput
      ) {
        if (type == "broadcast") {
          fastapp.socketio.sockets.emit(emitEvent, dataOutput);
        }
        if (type == "peer") {
          sock.emit(emitEvent, dataOutput);
        }
        if (type == "others") {
          console.log(sock);
        }
        console.log(emitEvent);
        console.log(dataOutput);
      });
    } else {
      console.log(123);
    }
    /*************************
     * call actual controller functions
     */
  });
  fastapp.socketio.use(fastapp.router);
};
function requestProcessor(req, callback) {
  var requestStructure = {};
  var processedResponse = {};
  if (req.method === "POST") {
    let postbody = "";
    req.on("data", chunk => {
      postbody += chunk.toString(); // convert Buffer to string
    });
    req.on("end", () => {
      var query = fastapp.url.parse(req.url, true);
      var paths = query.pathname.substr(1, query.pathname.length).split("/");

      requestStructure.controller = paths[0];
      requestStructure.action = paths[1];
      requestStructure.query = parse(postbody); //basic decoded query
      /* decoded request data**/
      if (typeof requestStructure.query.requestData != "undefined") {
        requestStructure.query.requestData = JSON.parse(
          requestStructure.query.requestData
        );
      }
      
      try {
        var controller = require(fastapp.config.rootFolder +
          "controllers/" +
          requestStructure.controller);

        if (typeof controller.actions[requestStructure.action] == "function") {
          controller.actions[requestStructure.action](
            requestStructure.query,
            function(processedResponse) {
              if (typeof processedResponse.status == "undefined") {
                processedResponse.status = "ok";
              }
              if (fastapp.config.debug) {
                processedResponse.query = requestStructure.query;
              }
              return callback(processedResponse);
            }
          );
        } else {
          if (fastapp.config.debug) {
            processedResponse.query = requestStructure.query;
          }
          processedResponse.status = "error";
          processedResponse.output = "Invalid Action" + requestStructure.action;
        }
      } catch (e) {
        if (e.code !== "MODULE_NOT_FOUND") {
          throw e;
        }
        console.log(e);
        
        if (fastapp.config.debug) {
          processedResponse.query = requestStructure.query;
        }
        processedResponse.status = "error";
        processedResponse.output =
          "Invalid Controller :" + requestStructure.controller;
      }

      return callback(processedResponse);
    });
  } else {
    if (fastapp.config.debug) {
      processedResponse.query = requestStructure.query;
    }
    processedResponse.status = "error";
    processedResponse.output = "Invalid Method: [" + req.method + "]";
    return callback(processedResponse);
  }
}
module.exports = fastapp;

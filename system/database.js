const fastapp = require('./loader');
var query = function (sql, callback, showFields = false) {
  var con = fastapp.mysql.createConnection(fastapp.config.database);

  con.connect(function (err) {
    if (err) throw err;
    con.query(sql, function (err, result) {
      if (err) throw err;
      var resultArray = Object.values(JSON.parse(JSON.stringify(result)))
      var output = {};
      output = { "result": resultArray };
      con.end();
      return callback(output);
    });
  });
}
module.exports.query = query;
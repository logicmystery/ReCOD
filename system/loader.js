/************
 * 
 * load basic libs
 * 
 */
var systemLoader = {}
systemLoader.config = require("./config")
systemLoader.nodemailer = require("nodemailer")
systemLoader.moment = require("moment-timezone")
systemLoader.url = require("url")
systemLoader.https = require("https")
systemLoader.fs = require("fs")
systemLoader.router = require("socket.io-events")()
systemLoader.socketio = require("socket.io")(systemLoader.config.socketPort)
systemLoader.mysql = require('mysql')
systemLoader.helpers = require("./helpers")
module.exports = systemLoader;

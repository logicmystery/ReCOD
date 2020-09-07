/**
 * basic congifuration
 */
fastappConfig={};
fastappConfig.rootFolder = "\/home\/apphost\/node\/recodserver\/"
fastappConfig.port=9996
// fastappConfig.socketPort=9991;
fastappConfig.host="0.0.0.0";
fastappConfig.debug=true;
fastappConfig.database={
    host: "localhost",
    user: "apphost",
    password: "xy7i&mfu]%e!",
    database: "recod",
    dateStrings : true
  };
fastappConfig.smtp = {
 /* host: "mail.twildy.com",
  port: 25,
  secure: false,*/ // upgrade later with STARTTLS
   service: 'gmail',
  auth: {
    user: 'pratik@logicmystery.com',
	    pass: 'pratik@2017',
	    secureProtocol: 'TLSv1_method'

  }
  /*,
  tls: {rejectUnauthorized: false}*/
  
}
fastappConfig.dateTime={
  timezone:"Asia/Kolkata",
  format:"YYYY-MM-DD HH:mm:ss"
}
fastappConfig.contentType="application/json"
module.exports = fastappConfig;

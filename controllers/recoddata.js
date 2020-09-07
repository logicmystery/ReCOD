const fastapp = require("../system/loader");
const database = require("../system/database")
var actions = {};
/********
 * user functions
 * **************************/
actions.register = function (query, callback) {
  console.log(query);
  // callback({
  //   status: "error",
  //   output: query
  // });
  // return;

  var sql = "select count(*) as count from users where user_aadhar='" + query.requestData.adhar_number + "'";
  database.query(sql, function (result) {
    if (result.result[0]["count"] > 0) {
      callback({
        status: "error",
        output: "Adhar number already registered!"
      });
      return;
    }
  });
  var datetime = fastapp.moment().tz(fastapp.config.dateTime.timezone).format(fastapp.config.dateTime.format);
  var sql =
    "insert into users(user_name,user_email,user_phone,user_aadhar,user_created_at) values('" +
    query.requestData.user_name +
    "','','" + query.requestData.phone_number +
    "','" +
    query.requestData.adhar_number +
    "','" +
    datetime +
    "');";
  database.query(sql, function (result) {

    //if (result.result.length != 0) {
    return callback({
      status: "success",
      output: "Patient Informetion Submited. Thank You"
    });
    // } else {
    //   return callback({
    //     status: "failed"
    //   });
    // }
  });
};

actions.insertdata = function (query, callback) {
  // console.log(query.requestData);
  // callback({
  //   status: "error",
  //   output: query
  // });
  // return;

  var sql = "select count(*) as count from tests where test_unique_catrage_no='" + query.requestData.test_unique_catrage_no + "'";
  database.query(sql, function (result) {
    if (result.result[0]["count"] > 0) {
      callback({
        status: "error",
        output: "Test_unique_catrage_no already registered!"
      });
      return;
    } else {
      var datetime = fastapp.moment().tz(fastapp.config.dateTime.timezone).format(fastapp.config.dateTime.format);
      var sql =
        "insert into tests(test_technician_id,test_unique_catrage_no,test_device_id,test_timestamp,test_type,test_result,test_patient_name,test_patient_uid_number,test_patient_phone_number,test_created_at) values('" +
        query.requestData.test_technician_id +
        "','" +
        query.requestData.test_unique_catrage_no +
        "','" +
        query.requestData.test_device_id +
        "','" +
        query.requestData.test_timestamp +
        "','" +
        query.requestData.test_type +
        "','" +
        query.requestData.test_result +
        "','" +
        query.requestData.patient_name +
        "','" +
        query.requestData.patient_uid_number +
        "','" +
        query.requestData.patient_phone_number +
        "','" +
        datetime +
        "');";
      database.query(sql, function (result) {

        //if (result.result.length != 0) {
        return callback({
          status: "success",
          output: "Information Submited successfully !. Thank You"
        });
        // } else {
        //   return callback({
        //     status: "failed"
        //   });
        // }
      });
    }
  });
};

actions.fetchdata = function (query, callback) {
  // console.log(query);
  var sql = "select * from tests where 1!=1 ";

  if (typeof query.requestData.test_unique_catrage_no != "undefined") {
    if (query.requestData.test_unique_catrage_no != "") {
      sql += " OR test_unique_catrage_no = '" +
        query.requestData.test_unique_catrage_no +
        "' "
    }
  }
  if (typeof query.requestData.patient_uid_number != "undefined") {
    if (query.requestData.patient_uid_number != "") {
      sql += "  OR test_patient_uid_number = '" +
        query.requestData.patient_uid_number +
        "' "
    }
  }
  if (typeof query.requestData.patient_phone_number != "undefined") {
    if (query.requestData.patient_phone_number != "") {
      sql += "  OR test_patient_phone_number = '" +
        query.requestData.patient_phone_number +
        "' "
    }
  }
  sql += "ORDER BY  test_timestamp DESC LIMIT 0,1"
  // console.log(sql);
  database.query(sql, function (result) {
    console.log(result);
    if (result.result.length == 0) {
      return callback({
        status: "error",
        msg: "No data found"
      });
    } else {
    return callback({
      status: "success",
      output: result.result[0]
    });
  }
  });
};

actions.login = function (query, callback) {
  var sql =
    "select technician_ID from technicians where technician_email = '" +
    query.requestData.user_email +
    "' and technician_password = '" +
    query.requestData.user_password +
    "'";
  database.query(sql, function (result) {
    // console.log(result);
    if (result.result.length == 0) {
      return callback({
        status: "failed",
        msg: "Incorrect access"
      });
    } else {
      return callback({
        status: "success",
        technician_ID: result.result[0]["technician_ID"],
        msg: "Welcome " + query.user_name
      });
    }
  });
};

actions.user_otp_verify = function (query, callback) {
  var sql = "select * from users where user_ID = '" + query.requestData.user_ID + "' ";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result
    });
  });
};

actions.forgot_mail = function (query, callback) {
  // console.log(query.requestData)
  var sql =
    "select user_name,user_password,user_email from users where user_email = '" +
    query.requestData.user_email +
    "' ";
  database.query(sql, function (result) {
    if (result.result.length != 0) {
      var transporter = fastapp.nodemailer.createTransport(fastapp.config.smtp);
      var mailOptions = {
        from: "pratik@logicmystery.com",
        to: "" + query.requestData.user_email + "",
        subject: "Forgot username and password",
        html:
          "<p>Dear user,<br><br>Your username is <b>" +
          result.result[0]["user_email"] +
          "</b> & Password is <b>" +
          result.result[0]["user_password"] +
          "</b>. Do not share it with anyone by any means. This is confidential and to be used by you only.<br><br><b>Regards,<br>Lamazi Pvt Ltd.</b></p>"
      };

      transporter.sendMail(mailOptions, function (error, info) {
        if (error) {
          console.log(error);
        } else {
          console.log("Email sent: " + info.response);
        }
      });
      return callback({
        status: "success",
        output: result
      });
    } else {
      return callback({
        status: "failed"
      });
    }
  });
};

actions.view = function (query, callback) {
  var sql = "select * from users";
  database.query(sql, function (result) {
    console.log(result);
    return callback({
      status: "success",
      output: result.result[0]
    });
  })
}

/*********************************/
module.exports.actions = actions;

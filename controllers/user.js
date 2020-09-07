const fastapp = require("../system/loader");
const database = require("../system/database");
const msg91 = require("msg91-sms");
const fastappCfg = require("../system/config");
// const crypto = require('crypto');
var request = require("request");


var actions = {};
/********
 * user functions
 * **************************/
actions.register = function (query, callback) {
  let password = crypto.createHash('md5').update(query.requestData.USRPS).digest("hex");

  if (query.requestData.PHNR1.length != 10) {
    return callback({
      status: "error",
      output: "Mobile number must be 10 digit"
    });
  }
  var sql = "select count(*) as count from users where PHNR1='" + query.requestData.PHNR1 + "'";
  database.query(sql, function (result) {
    if (result.result[0]["count"] > 0) {
      callback({
        status: "error",
        output: "Mobile Number already registered!"
      });
      return;
    } else {
      var datetime = fastapp.moment().tz(fastapp.config.dateTime.timezone).format(fastapp.config.dateTime.format);
      var transporter = fastapp.nodemailer.createTransport(fastapp.config.smtp);
      var my_otp = fastapp.helpers.otp_generator();
      var mailOptions = {
        from: "noreply@legally.com",
        to: "" + query.requestData.EMLID + "",
        subject: "OTP Request for Registration",
        html: "<p>Dear user,<br><br>Your OTP from LEGALYY is <b>" +
          my_otp +
          "</b>. Do not share it with anyone by any means. This is confidential and to be used by you only.<br><br><b>Regards,<br>twidly Pvt Ltd.</b></p>"
      };

      transporter.sendMail(mailOptions, function (error, info) {
        if (error) {
          console.log(error);
        } else {
          console.log("Email sent: " + info.response);
        }
      });


      var sql =
        "insert into users(CTNM1,CTNM2,PHNR1,EMLID,USRID,CHGDT,USRPS,CPMIN) values('" +
        query.requestData.CTNM1 +
        "','" +
        query.requestData.CTNM2 +
        "','" +
        query.requestData.PHNR1 +
        "','" +
        query.requestData.EMLID +
        "','" +
        query.requestData.USRID +
        "','" +
        datetime +
        "','" +
        password +
        "','0');";


      database.query(sql, function (result) {
        // var message =
        //   "Hi " +
        //   query.requestData.user_name +
        //   ",\nWelcome To Twidly,\n Your Twidly Username : " +
        //   query.requestData.user_contact_no +
        //   " and \n Password: " +
        //   query.requestData.user_password +
        //   " .\n Login With This Valid Credential. \nRegards , Twidly Management";
        // msg91.sendOne(
        //   fastappCfg.msg91.authkey,
        //   query.requestData.user_contact_no,
        //   message,
        //   fastappCfg.msg91.senderid,
        //   fastappCfg.msg91.route,
        //   fastappCfg.msg91.dialcode,
        //   function (response) {
        //     console.log(response);

        //     callback({ status: "success", output: message });
        //   });

        return callback({
          status: "success",
          sucmsg: "Check Your Mobile Number, We Will Send Your Login Details To Your Mobile Number"
        });

      });

    };
  });
};

actions.login = function (query, callback) {
  // let hashpassword = crypto.createHash('md5').update(query.requestData.user_password).digest("hex");

  var sql = "select * from users where user_email = '" + query.requestData.user_email + "' and user_password = '" + query.requestData.user_password + "'";
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
        output: result.result[0]
      });
    }
  });
};

actions.user_otp_verify = function (query, callback) {
  var sql =
    "select * from users where user_ID = '" + query.requestData.user_ID + "' ";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result
    });
  });
};

actions.fetchDashboard = function (query, callback) {
  var sql = "select * from users where user_ID  = '" + query.user_ID + "' ";

  // var sql = "select * from users join il_tstate on il_tstate.STECD=users.STECD where user_ID  = '" + query.user_ID + "' ";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result.result[0]
    });
  });
};

actions.fetchCountry = function (query, callback) {
  var sql = "select * from il_tcntnm ORDER BY `il_tcntnm`.`CNTNM` ASC";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result
    });
  });
};

actions.fetchState = function (query, callback) {
  var sql = "select * from il_tstate where CNTCD='" + query.requestData.CNTCD + "' ORDER BY `il_tstate`.`STANM` ASC";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result
    });
  });
};

actions.profile_update = function (query, callback) {
  var sql = "UPDATE `users` SET `ADDR1` = '" + query.requestData.ADDR1 + "',ADDR2='" + query.requestData.ADDR2 + "',AERCD='" + query.requestData.AERCD + "',CNTCD='" + query.requestData.CNTCD + "',CTNM1='" + query.requestData.CTNM1 + "',CTNM2='" + query.requestData.CTNM2 + "',CTTYP='" + query.requestData.CTTYP + "',FAXNR='" + query.requestData.FAXNR + "',IDNR1='" + query.requestData.IDNR1 + "',IDNR2='" + query.requestData.IDNR2 + "',IDTYP='" + query.requestData.IDTYP + "',PHNR1='" + query.requestData.PHNR1 + "',PHNR2='" + query.requestData.PHNR2 + "',STECD='" + query.requestData.STECD + "',TAXEX='" + query.requestData.TAXEX + "',TAXNR='" + query.requestData.TAXNR + "' WHERE `users`.`user_ID` ='" + query.user_ID + "' ";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result.result[0]
    });
  });
};

actions.changePass = function (query, callback) {
  let oldpassword = crypto.createHash('md5').update(query.requestData.old_USRPS).digest("hex");
  let newPassword = crypto.createHash('md5').update(query.requestData.USRPS).digest("hex");

  var sql = "select USRPS from users where  user_ID  = '" + query.user_ID + "' ";
  database.query(sql, function (result) {
    if (result.result[0].USRPS == oldpassword) {
      var sql = "UPDATE `users` SET `USRPS` = '" + newPassword + "' where   user_ID  = '" + query.user_ID + "' ";
      database.query(sql, function (result) {
        return callback({
          status: "success",
          output: result.result[0],
          sucmsg: "Password Changed Succesfully"
        });
      });
    } else {
      return callback({
        status: "failed",
        errmsg: "Old Password is not match"
      });
    }
  });
};

actions.getStates = function (query, callback) {
  var sql = "SELECT `S`.`STANM`, `S`.`STECD` FROM `il_tstate` AS `S` LEFT JOIN `il_tsramr` AS `A` ON `S`.`STECD`=`A`.`STECD` WHERE `A`.`ACTIV` = 'X' GROUP BY `A`.`STECD`";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result,
    });
  });
};

actions.getStatesFromCrntLocation = function (query, callback) {
  var sql = "SELECT `S`.`STANM`, `S`.`STECD` FROM `il_tstate` AS `S` LEFT JOIN `il_tsramr` AS `A` ON `S`.`STECD`=`A`.`STECD` WHERE `A`.`ACTIV` = 'X' AND STANM LIKE '" + query.requestData.currentlocation + "' GROUP BY `A`.`STECD`";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result,
    });
  });
};


actions.getCategoryID = function (query, callback) {
  var sql = "SELECT `C`.`CATID` FROM `il_tsermr` AS `S` LEFT JOIN `il_tsramr` AS `A` ON `S`.`SERNR`=`A`.`SERNR` LEFT JOIN `il_tsrcmr` AS `C` ON `S`.`CATCD`=`C`.`CATCD` WHERE `A`.`ACTIV` = 'X' AND `A`.`STECD` = '" + query.requestData.STECD + "' GROUP BY `C`.`CATID`";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result
    });
  });
};

actions.getDataFromCategoryID = function (query, callback) {
  // console.log(query.requestData.CATID);
  var sql = "SELECT * FROM `il_tsrcmr` WHERE `CATID` IN (" + query.requestData.CATID + ") AND `SUBID` = '' AND `SSBID` = '' ORDER BY `CATCD` ASC";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result,
    });
  });
};

actions.getSubCategoryID = function (query, callback) {
  var sql = "SELECT `C`.`SUBID`, `C`.`CATID` FROM `il_tsermr` AS `S` LEFT JOIN `il_tsramr` AS `A` ON `S`.`SERNR`=`A`.`SERNR` LEFT JOIN `il_tsrcmr` AS `C` ON `S`.`CATCD`=`C`.`CATCD` WHERE `A`.`ACTIV` = 'X' AND `A`.`STECD` = '" + query.requestData.STECD + "' AND `C`.`CATID` = '" + query.requestData.CATID + "' GROUP BY `C`.`SUBID`";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result
    });
  });
};

actions.getDataFromSubCategoryID = function (query, callback) {
  // console.log(query.requestData.CATID);
  var sql = "SELECT * FROM `il_tsrcmr` WHERE `CATID` IN (" + query.requestData.CATID + ") AND `SUBID` IN (" + query.requestData.SUBID + ") AND `SSBID` = '' ORDER BY `CATCD` ASC";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result,
    });
  });
};

actions.getSuperSubCategory = function (query, callback) {
  var sql = "SELECT `S`.`SERNM`, `S`.`SERNR`, `S`.`CATCD`, `A`.`STECD` FROM `il_tsermr` AS `S` LEFT JOIN `il_tsramr` AS `A` ON `S`.`SERNR`=`A`.`SERNR` LEFT JOIN `il_tsrcmr` AS `C` ON `S`.`CATCD`=`C`.`CATCD` WHERE `A`.`ACTIV` = 'X' AND `A`.`STECD` = '" + query.requestData.STECD + "' AND `C`.`CATID` = '" + query.requestData.CATID + "' AND `C`.`SUBID` = '" + query.requestData.SUBID + "' GROUP BY `A`.`SERNR`  ";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result
    });
  });
};

actions.getServices = function (query, callback) {
  var sql = "SELECT `S`.`SERNM`, `S`.`SERNR`, `A`.`STECD` FROM `il_tsermr` AS `S` LEFT JOIN `il_tsramr` AS `A` ON `S`.`SERNR`=`A`.`SERNR` WHERE `A`.`ACTIV` = 'X' AND `A`.`STECD` = '" + query.requestData.STECD + "' GROUP BY `A`.`SERNR`";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result,
    });
  });
};

actions.getStatebyservice = function (query, callback) {
  var sql = "SELECT * FROM `il_tstate` WHERE `STECD` = '" + query.requestData.STECD + "' ";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result.result[0],
    });
  });
};

actions.getSubCatbyCat = function (query, callback) {
  var sql = "SELECT * FROM `il_tsrcmr` WHERE `CATID` = '" + query.requestData.CATID + "' AND `SUBID` = '' AND `SSBID` = '' ORDER BY `CATCD` ASC ";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result.result[0],
    });
  });
};

actions.getSuperSubCatbysubCat = function (query, callback) {
  var sql = "SELECT * FROM `il_tsrcmr` WHERE `CATID` = '" + query.requestData.CATID + "' AND `SUBID` ='" + query.requestData.SUBID + "' AND `SSBID` = '' ORDER BY `CATCD` ASC ";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result.result[0],
    });
  });
};

actions.getServicebyservice = function (query, callback) {
  var sql = "SELECT * FROM `il_tsermr` WHERE `SERNR` = '" + query.requestData.SERNR + "' ";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result.result[0],
    });
  });
};

actions.getserQstn = function (query, callback) {
  var sql = "SELECT `P`.*, `A`.`ARENM`, `A`.`ARECD`,`S`.`SERNM` FROM `il_tsrpmr` AS `P` LEFT JOIN `il_tsramr` AS `A` ON `P`.`ARENR`=`A`.`ARENR` LEFT JOIN `il_tsermr` AS `S` ON `S`.`SERNR`=`A`.`SERNR` WHERE `P`.`SERNR` = '" + query.requestData.SERNR + "' AND `A`.`STECD` = '" + query.requestData.STECD + "' AND `P`.`ACTIV` = 'X'";
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result,
    });
  });
};

actions.getQstn2 = function (query, callback) {
  var sql = "SELECT * FROM `il_tqnrmr` WHERE `SERNR` = '" + query.requestData.SERNR + "' AND `ARENR` = '" + query.requestData.ARENR + "' AND `ACTIV` = 'X' ORDER BY `QNRNR` ASC  ";
  // console.log(sql);

  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result,
    });
  });
};

actions.totalOrderCount = function (query, callback) {
  var sql = "SELECT count(*) as total_order FROM `il_torhdr` as `O` WHERE `O`.`ORDST` = 'OPEN' AND `O`.`user_ID` = '" + query.user_ID + "'"

  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result.result[0],
    });
  });
}
actions.totalPaidAmount = function (query, callback) {
  var sql = "SELECT SUM(ORDGT) total_paid_amount FROM `il_torhdr` WHERE user_ID='" + query.user_ID + "' AND CPMST='CLRD' ORDER BY `il_torhdr`.`ORDNR` DESC"
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result.result[0],
    });
  });
}
actions.totalDueAmount = function (query, callback) {
  var sql = "SELECT SUM(ORDGT) total_due_amount FROM `il_torhdr` WHERE user_ID='" + query.user_ID + "'  AND CPMST='open' ORDER BY `il_torhdr`.`ORDNR` DESC"
  database.query(sql, function (result) {
    // console.log(result.result[0]);

    return callback({
      status: "success",
      output: result.result[0],
    });
  });
}
actions.totalUnassignedOrder = function (query, callback) {
  var sql = "SELECT COUNT(ORDNR) as totalUnassignedOrder FROM `il_torhdr` WHERE user_ID='" + query.user_ID + "' AND ORDST='open' ORDER BY `il_torhdr`.`ORDNR` DESC  "
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result.result[0],
    });
  });
}

actions.inprogressOrderCount = function (query, callback) {
  var sql = "SELECT COUNT(*) as inprogress FROM `il_torhdr` as `O` WHERE `O`.`ORDST` != 'COMPLETE' AND `O`.`user_ID` ='" + query.user_ID + "'"

  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result.result[0],
    });
  });
}

actions.completedOrderCount = function (query, callback) {
  var sql = "SELECT COUNT(*) as completed FROM `il_torhdr` as `O` WHERE `O`.`ORDST` = 'COMPLETE' AND `O`.`user_ID` ='" + query.user_ID + "'"

  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result.result[0],
    });
  });
}

actions.totalOrderDetails = function (query, callback) {
  var sql = "SELECT `I`.`ORDNR`, `I`.`ORDDT`, `I`.`SHPDT`, GROUP_CONCAT(I.PRCTM SEPARATOR ' days,') AS PRCTM,GROUP_CONCAT(I.PRDVLD SEPARATOR ',') AS PRDVLD, `I`.`PRDTYP`, `O`.`ORDST`, `O`.`ORDGT`, `O`.`CPMST`, `O`.`CURCN`, GROUP_CONCAT(S.SERNM SEPARATOR ',') AS SERNM, GROUP_CONCAT(A.ARENM SEPARATOR ',') AS ARENM, `V`.`VNNM1`, `V`.`VENNR` FROM `il_toritm` AS `I` LEFT JOIN `il_torhdr` AS `O` ON `I`.`ORDNR`=`O`.`ORDNR` LEFT JOIN `il_tsermr` AS `S` ON `I`.`SERNR`=`S`.`SERNR` LEFT JOIN `il_tsramr` AS `A` ON `I`.`ARENR`=`A`.`ARENR` LEFT JOIN `il_tvenmr` AS `V` ON `I`.`VENNR`=`V`.`VENNR` WHERE `O`.`user_ID` = '" + query.user_ID + "' GROUP BY `ORDNR` ORDER BY `O`.`ORDNR` DESC"
  // console.log(sql);

  database.query(sql, function (result) {

    return callback({
      status: "success",
      output: result,
    });
  });
}

actions.completedOrderDetails = function (query, callback) {
  var sql = "SELECT `I`.`ORDNR`, `I`.`ORDDT`, `I`.`SHPDT`, GROUP_CONCAT(I.PRCTM SEPARATOR ' days,') AS PRCTM,GROUP_CONCAT(I.PRDVLD SEPARATOR ',') AS PRDVLD, `I`.`PRDTYP`, `O`.`ORDST`, `O`.`ORDGT`, `O`.`CPMST`, `O`.`CURCN`, GROUP_CONCAT(S.SERNM SEPARATOR ',') AS SERNM, GROUP_CONCAT(A.ARENM SEPARATOR ',') AS ARENM, `V`.`VNNM1`, `V`.`VENNR` FROM `il_toritm` AS `I` LEFT JOIN `il_torhdr` AS `O` ON `I`.`ORDNR`=`O`.`ORDNR` LEFT JOIN `il_tsermr` AS `S` ON `I`.`SERNR`=`S`.`SERNR` LEFT JOIN `il_tsramr` AS `A` ON `I`.`ARENR`=`A`.`ARENR` LEFT JOIN `il_tvenmr` AS `V` ON `I`.`VENNR`=`V`.`VENNR` WHERE `O`.`user_ID` = '" + query.user_ID + "' AND ORDST='Complete' GROUP BY `ORDNR` ORDER BY `O`.`ORDNR` DESC"
  // console.log(sql);

  database.query(sql, function (result) {

    return callback({
      status: "success",
      output: result,
    });
  });
}

actions.inprogressOrderDetails = function (query, callback) {
  var sql = "SELECT `I`.`ORDNR`, `I`.`ORDDT`, `I`.`SHPDT`, GROUP_CONCAT(I.PRCTM SEPARATOR ' days,') AS PRCTM,GROUP_CONCAT(I.PRDVLD SEPARATOR ',') AS PRDVLD, `I`.`PRDTYP`, `O`.`ORDST`, `O`.`ORDGT`, `O`.`CPMST`, `O`.`CURCN`, GROUP_CONCAT(S.SERNM SEPARATOR ',') AS SERNM, GROUP_CONCAT(A.ARENM SEPARATOR ',') AS ARENM, `V`.`VNNM1`, `V`.`VENNR` FROM `il_toritm` AS `I` LEFT JOIN `il_torhdr` AS `O` ON `I`.`ORDNR`=`O`.`ORDNR` LEFT JOIN `il_tsermr` AS `S` ON `I`.`SERNR`=`S`.`SERNR` LEFT JOIN `il_tsramr` AS `A` ON `I`.`ARENR`=`A`.`ARENR` LEFT JOIN `il_tvenmr` AS `V` ON `I`.`VENNR`=`V`.`VENNR` WHERE `O`.`user_ID` = '" + query.user_ID + "' AND ORDST !='Complete' GROUP BY `ORDNR` ORDER BY `O`.`ORDNR` DESC"
  // console.log(sql);

  database.query(sql, function (result) {

    return callback({
      status: "success",
      output: result,
    });
  });
}

actions.getCartData = function (query, callback) {
  // console.log(query.requestData);

  var sql = "SELECT `P`.*, `S`.`SERNM`, `S`.`PRDVLD`, `S`.`PRDTYP`, `A`.`ARENM` FROM `il_tsrpmr` AS `P` LEFT JOIN `il_tsermr` AS `S` ON `P`.`SERNR`=`S`.`SERNR` LEFT JOIN `il_tsramr` AS `A` ON `P`.`ARENR`=`A`.`ARENR` WHERE `P`.`SERNR` = '" + query.requestData.SERNR + "' AND `P`.`PRSNR` = '" + query.requestData.PRSNR + "' AND `P`.`ACTIV` = 'X'  "
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result,
    });
  });
}

actions.searchService = function (query, callback) {
  var sql = "SELECT `S`.`SERNM`, `S`.`SERNR`, `A`.`STECD`, `B`.CATID,`B`.SUBID FROM `il_tsermr` AS `S` LEFT JOIN `il_tsramr` AS `A` ON `S`.`SERNR`=`A`.`SERNR` LEFT JOIN `il_tsrcmr` AS `B` ON `S`.`CATCD`=`B`.`CATCD` WHERE `A`.`ACTIV` = 'X' AND `SERNM` LIKE '%" + query.requestData.searchvalue + "%' GROUP BY `A`.`SERNR` "
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result,
    });
  });
}

actions.getCoupon = function (query, callback) {
  var datetime = fastapp.moment().tz(fastapp.config.dateTime.timezone).format(fastapp.config.dateTime.format);
  var sql = "SELECT * FROM `il_tcoupn` WHERE `CUPCD` = '" + query.requestData.coupon_code + "' AND DATE(VLDFM) <= '" + datetime + "' AND DATE(VLDTO) >= '" + datetime + "' ORDER BY `CUPCD` ASC  "
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result.result,
    });
  });
}

actions.otplogin = function (query, callback) {
  // console.log(query.requestData);
  var sql = "SELECT * FROM `users` WHERE `PHNR1` LIKE '" + query.requestData.mobile_number + "' OR PHNR2 LIKE '" + query.requestData.mobile_number + "'"
  database.query(sql, function (result) {
    // console.log(result.result);

    if (result.result.length != 0) {
      var message = "Hi " + result.result[0].USRID + ",\n Your OTP from LEGALYY is " + query.requestData.otp + ""

      request.get(
        "http://sdgmapi.in/V2/http-api.php?apikey=nZ9vMG0RzFKkc0k4&senderid=LEGLYY&number=" + result.result[0].PHNR1 + "&message=" + message + "&format=json",
        function (error, response, body) {
          console.log(response.body);

          if (response.body.status == "OK") {
            callback({
              status: "success",
              output: response.body
            });
          } else {
            callback({
              status: error,
              output: response
            });
          }

        }
      );
    }
    return callback({
      status: "success",
      output: result,
    });
  });
}

actions.getouterService = function (query, callback) {
  var sql = 'SELECT * FROM `il_tsrcmr` WHERE `CATTL` = "' + query.requestData.servicename + '" '
  database.query(sql, function (result) {
    return callback({
      status: "success",
      output: result.result[0],
    });
  });
}

actions.schedule = function (query, callback) {
  var sqlselect = "select * from users left join il_tstate on il_tstate.STECD=users.STECD  where user_ID  = '" + query.user_ID + "' ";
  database.query(sqlselect, function (result) {
    var remain_time = result.result[0].CPMIN - 30;
    var sql = 'UPDATE `users` SET `CPMIN` = ' + remain_time + ' WHERE `user_ID` ="' + query.user_ID + '"'
    database.query(sql, function (result) {
      return callback({
        status: "success",
        output: result,
      });
    })
  });
}

actions.getorderdetails = function (query, callback) {
  var sqlselect = "SELECT * FROM `il_toritm` JOIN il_torhdr ON il_toritm.ORDNR = il_torhdr.ORDNR WHERE il_toritm.`ORDNR` = '" + query.requestData.orderID + "' ";
  database.query(sqlselect, function (result) {
    return callback({
      status: "success",
      output: result.result[0],
    });
  });
}


/*********************************/
module.exports.actions = actions;
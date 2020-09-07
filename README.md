# ReCOD

CORONA TEST REPORT TRACKING SERVER

# Folder Structure

    there are 2 folders

    1) recodeNodeApi is a nodejs based api
    2) recodePHPadmin is a php(5.6) based admin panel

database used mysql

the system is under construction!

# Request & Responce

    sample request structure for insert

    requestData:{
        "test_unique_catrage_no": 121234445,
        "test_technician_id": 10000001,
        "test_device_id": 100000,
        "patient_phone_number": 9876543210,
        "patient_uid_number": 123456789012,
        "patient_name": "Santa Prasad",
        "test_timestamp": "2020-08-14 00:00:00",
        "test_type": "Diagnostic",
        "test_result": false
    }
endpoing : https://recod.apphost.cloud:9996/recoddata/insertdata

    server response: 
        {
        status: "success",
        output: "Patient Informetion Submited. Thank You"
        }

  sample request structure for fetchdata

    requestData:{
        "test_unique_catrage_no": 121234445,
        "patient_phone_number": 9876543210,
        "patient_uid_number": 123456789012,
    }
endpoing : https://recod.apphost.cloud:9996/recoddata/fetchdata

    server response: 
        {
        status: "success",
        output: {
                "test_unique_catrage_no": 121234445,
                "test_technician_id": 10000001,
                "test_device_id": 100000,
                "patient_phone_number": 9876543210,
                "patient_uid_number": 123456789012,
                "patient_name": "Santa Prasad",
                "test_timestamp": "2020-08-14 00:00:00",
                "test_type": "Diagnostic",
                "test_result": false
            }
        }
**N.B: All request will be in post format with json payload
### for further query please contact admin@logicmystery.com


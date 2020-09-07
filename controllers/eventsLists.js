/******register events mapper********** */
eventsMapper={};
eventsMapper.typing = function(params,callback) {
    callback("broadcast","typing", {username : "test"});
}
eventsMapper.new_message = function (params,callback) {
    callback("others","new_message",  {message :params.message, username : "ts"});
}
module.exports.eventsMapper = eventsMapper;
//listen on new_message

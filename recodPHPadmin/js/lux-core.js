
function Lux_Core() {
// SYSTEM CONSTANTS
    this.BASE_PATH = base_url;
    this.CSS_LOADED = [];
    this.LOGGING = true;
    // core init override
    this.init = function() {
        var ctx = this;
        ctx.log("init: Luxify core js library loaded");
        // setup mobile first dynamic css loading
        $(window).resize(function() {
            ctx.loadCSS(ctx);
        });
        this.loadCSS(ctx);
        // language switcher
        ctx.log("set language switcher");
        this.language_switcher();
        // module specific processing
        this.initModule();
        this.getLocation();
    }
// module specific override
    this.initModule = function() {
        var ctx = this;
        ctx.log("initModule: extend by overriding this function in other modules");
    }

// LIBRARY FUNCTIONS
// general debug log, remove on launch
    this.log = function(message) {
        if (this.LOGGING)
            console.log(message);
    }
// dynamic css load on media queries for different devices
    this.loadCSS = function(ctx) {
        var mediaQueries = document.querySelectorAll(".media-dependent");
        var all = mediaQueries.length;
        var cur = null, attr = null, css = null;
        while (all--) {
            cur = mediaQueries[all];
            if (cur.dataset.media &&
                    window.matchMedia(cur.dataset.media).matches) {
                for (attr in cur.dataset) {
                    if (attr !== 'media') {
                        css = cur.dataset[attr];
                        if (ctx.CSS_LOADED.indexOf(css) < 0) {
                            ctx.log("loadCSS: " + css);
                            cur.setAttribute(attr, css);
                            ctx.CSS_LOADED.push(css);
                        }
                    }
                }
            }
        }
    }
// core ajax loading
    this.loadAjax = function(ctx, url, data, callback, dataType, postType, asyncCall) {
        var ctx = ctx;
        $.ajax({
            type: postType ? postType : "GET",
            url: url,
            dataType: dataType ? dataType : "xml",
            async: asyncCall != undefined ? asyncCall : true,
            data: data,
            success: function(data) {
                callback(ctx, data)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("error: " + textStatus);
            }
        });
    }
// language switcher
    this.language_switcher = function() {
        var region_language = $.cookie('region_language') == null ? function(){
            $.cookie('region_language',1, {expires: 365, path: '/'});
        } : $.cookie('region_language');
        $("#language_switcher").val(region_language);
        $("#language_switcher").on("change", function(e) {
            region_language = $(this).val();
            $.cookie('region_language', region_language, {expires: 365, path: '/'});
            window.location.reload()
        });
    }
// geo location
    this.getLocation = function() {
        function showPosition(position) {
            $("#geolocation").html("Latitude: " + position.coords.latitude +
                    "<br>Longitude: " + position.coords.longitude);
        }
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
           $("#geolocation").html("Geolocation is not supported by this browser.");
        }
    }


}


// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
        // Logged into your app and Facebook.
        testAPI();
    } else if (response.status === 'not_authorized') {
        // The person is logged into Facebook, but not your app.
        document.getElementById('status').innerHTML = 'Please log ' +
                'into this app.';
    } else {
        // The person is not logged into Facebook, so we're not sure if
        // they are logged into this app or not.
        document.getElementById('status').innerHTML = 'Please log ' +
                'into Facebook.';
    }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}

window.fbAsyncInit = function() {
    FB.init({
        appId: '531146800350458',
        cookie: true, // enable cookies to allow the server to access 
        // the session
        xfbml: true, // parse social plugins on this page
        version: 'v2.1' // use version 2.1
    });

    // Now that we've initialized the JavaScript SDK, we call 
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });

};

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
        console.log(response);
        document.getElementById('status').innerHTML =
                'Thanks for logging in, ' + response.name + '!';
    });
}

// js for countdown-to-weding plugin.
// All html added through js to keep it in one place.
jQuery(document).ready(function($) {
    // insert attribute for image and a map
    // Quick fix the admin error.
    if ($('#header img').size() > 0) {
        $('#header img').offsetParent().before('<map name="wedding_map"><area shape="rect" coords="0,0,349,140" href="http://svenskdam.se/" alt="svenskdam.se" /><area shape="rect" coords="350,0,790,140" href="http://svenskdam.se/kategori/victorias-daniels-brollop/" alt="Viktorias och daniels br&ouml;llop" /></map>');
        $('#header img').attr( 'useMap', '#wedding_map' );
    }
    
    //onecall at pageload. then it will loop;
    AllCount();
    
    function AllCount() {
    	// time vars 
        today = new Date();
        dDay = new Date(2010, 5, 19, 15, 30, 0); // month = 0-11
        oneDay = 1000*60*60*24;
        oneHour = 1000*60*60;
        oneMin = 1000*60;
        oneSec = 1000;
        
	// get the url for their special site.
        url = location.protocol + "//svenskdam.se/kategori/victorias-daniels-brollop/";

        // bool switches
	lastCounter = false;
        weddingTime = false;
        
        // get the time that differ from now to the wedding date/time
        diffTime = Math.ceil(dDay.getTime()-today.getTime());
	days = Math.floor(diffTime/oneDay);

        // aint gonna do anything unnessesary... only days in the counter til its 14 days left.
        if(days >= 14) {
	    // ceil this to not confuse
            days = Math.floor(diffTime/oneDay);
            diffTime = diffTime%oneDay;
            out =  days +" DAGAR";
        }
	// new counter with 14 days left;
        else {
	    // split the ms to time units we want.
            // floor this for correctness
	    days = Math.floor(diffTime/oneDay);
            diffTime = diffTime%oneDay;
            
            hours = Math.floor(diffTime/oneHour);
            diffTime = diffTime%oneHour;

            mins = Math.floor(diffTime/oneMin);
            diffTime = diffTime%oneMin;

            secs = Math.floor(diffTime/oneSec);

	    // different output if no days etc. left.
            if ( days > 0) {
                out = days + ' DAGAR ' + hours + ' TIMMAR<br>' + mins + ' MINUTER ' + secs + ' SEKUNDER';
            }
            else if( days <= 0 && hours > 0 ){
                out = hours + ' TIMMAR<br>' + mins + ' MINUTER ' + secs + ' SEKUNDER';
            }
            else if ( days <= 0 && hours <= 0 && mins > 0){
                out =  mins + ' MINUTER ' + secs + ' SEKUNDER';
            }
            else if ( days <= 0 && hours <= 0 && mins <= 0 && secs > 0){
                out = secs + ' SEKUNDER';
            }
            else {
	    	// switch to disable the counter and stop recursion.
                weddingTime = true;
            }
            // switch to new counter (need new style)
	    lastCounter = true;
        }

        // no recusrsion when wedding has set. and remove the trailing message.
	if (!weddingTime) {
	    // with more than 14 days left we only display days in our counter
            if (!lastCounter){
	        // check if div exist. runs only first time.
                if ( $('#countdown_to_wedding').size() == 0 ) { 
		    
		    // add div to hold countdown and message. observe the class counter used for styling 
	            $('#header').append('<div id="countdown_to_wedding"><div id="counter_holder"><div id="counter">' + 
                         '<a href="' + url + '" >' + out + '</a>' +
                         '</div>' + 
                         '<div id="counter_message"><a href="' + url + '" >kvar till Victorias & Daniels br&ouml;llop<br>L&auml;s allt p&aring; v&aring;r specialsajt</a></div>' +
                         '</div>');
                }
		// div exists. only change the counter part.
                else {
                    $('#counter').html('<a href="' + url + '" >' + out + '</a>');
                }
            }
	    // with less than 14 days we display more time units
	    else {
	        // check if div exist. runs only first time.
                if ( $('#countdown_to_wedding').size() == 0 ) { 
                    
		    // add div to hold countdown and message. observe the class last_counter used for styling 
	            $('#header').append('<div id="countdown_to_wedding"><div id="counter_holder"><div id="last_counter">' + 
                        '<a href="' + url + '" >' + out + '</a>' +
                        '</div>' + 
                        '<div id="counter_message"><a href="' + url + '" >kvar till Victorias & Daniels br&ouml;llop<br>L&auml;s allt p&aring; v&aring;r specialsajt</a></div>' +
                        '</div>');
                }
		// div exists. only change the counter part.
                else {
                    $('#last_counter').html('<a href="' + url + '" >' + out + '</a>');
                }
            }
            // while counting set "recursion" and call this function again after 1 sec delay. 
            setTimeout(arguments.callee, 1000);
	}
	// time for wedding. no more counting.
	else {
            if ( $('#countdown_to_wedding').size() != 0 ) { 
	    	// we need new style on so remove this one
	        $('#countdown_to_wedding').remove();
	    }
	    // add wedding time message.
            $('#header').append('<div id="wedding_time"><a href="' + url + '" >L&auml;s allt om Victorias &amp; Daniels br&ouml;llop p&aring; v&aring;r specialsajt</a></div>');
        }
    }
});

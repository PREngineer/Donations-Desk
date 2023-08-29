<?php

    header( "Content-type: text/event-stream" );
    header( "Cache-Control: no-cache" );
    ob_end_flush();

    while( true ){
        echo "event: new_song\n";
        echo "data: Jorge Pabón|Adele|Rolling in the Deep|Pop|C minor|English|song.cdg|song.mp3\n\n";
        flush();

        if( connection_aborted() ){
            break;
        }

        sleep( 10 );
    }

?>
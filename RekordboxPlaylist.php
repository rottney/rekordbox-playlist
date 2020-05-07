<?php
	$xml = simplexml_load_file("collection.xml");

	$playlist_name = "Primitive EDM Mix";

	$num_tracks = ($xml -> xpath("PLAYLISTS/NODE/NODE[@Name = '" . $playlist_name . "']/@Entries"))[0];

	$track_list = $xml -> xpath("PLAYLISTS/NODE/NODE[@Name = '" . $playlist_name . "']/TRACK");
	//print_r($track_list);

	for ($i = 0; $i < $num_tracks; $i++) {
		$key = $track_list[$i] -> attributes();
		//$all_metadata = $xml -> xpath("COLLECTION/TRACK[@TrackID = '" . $key . "']");
		//print_r($all_metadata);
		$artist = $xml -> xpath("COLLECTION/TRACK[@TrackID = '" . $key . "']/@Artist")[0];
		$track_name = $xml -> xpath("COLLECTION/TRACK[@TrackID = '" . $key . "']/@Name")[0];
		$label = $xml -> xpath("COLLECTION/TRACK[@TrackID = '" . $key . "']/@Label")[0];
		echo $i + 1 . ") ";
		echo $artist . " - ";
		echo $track_name . " [";
		echo $label . "]\n";
	}
?>

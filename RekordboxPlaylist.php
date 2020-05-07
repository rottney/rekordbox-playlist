<?php
	$xml = simplexml_load_file("collection.xml");
	$num_tracks = 0;

	echo "Please enter a playlist name.\n";
	$playlist_name = trim(fgets(STDIN));
	$num_tracks = ($xml -> xpath("PLAYLISTS/NODE/NODE[@Name = '" . $playlist_name . "']/@Entries"))[0];
	$track_list = $xml -> xpath("PLAYLISTS/NODE/NODE[@Name = '" . $playlist_name . "']/TRACK");

	while ($num_tracks == 0) {
		echo "Playlist '" . $playlist_name . "' is not a valid playlist, or it contains no tracks.\n"
			. "Please enter a valid playlist name.\n";
		$playlist_name = trim(fgets(STDIN));
		$num_tracks = ($xml -> xpath("PLAYLISTS/NODE/NODE[@Name = '" . $playlist_name . "']/@Entries"))[0];
		$track_list = $xml -> xpath("PLAYLISTS/NODE/NODE[@Name = '" . $playlist_name . "']/TRACK");
	}

	$myfile = fopen($playlist_name . ".txt", "w");
	for ($i = 0; $i < $num_tracks; $i++) {
		$key = $track_list[$i] -> attributes();
		$artist = $xml -> xpath("COLLECTION/TRACK[@TrackID = '" . $key . "']/@Artist")[0];
		$track_name = $xml -> xpath("COLLECTION/TRACK[@TrackID = '" . $key . "']/@Name")[0];
		$label = $xml -> xpath("COLLECTION/TRACK[@TrackID = '" . $key . "']/@Label")[0];
		fwrite($myfile, $i + 1 . ") " . $artist . " - " . $track_name . " [" . $label . "]\n");
	}
	fclose($myfile);

	echo "Playlist has been exported to file " . $playlist_name . ".txt,\n"
		. "which is located in the same folder as this script.\n";
?>

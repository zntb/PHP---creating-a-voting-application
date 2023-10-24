<?php
    // $dayOfYear = date('z') + 1; TODO: as soon as there is a question for each day, change it back
    $dayOfYear = 297;
    $data = json_decode(file_get_contents('./' . $dayOfYear . '.json'));
    // convert $data->answers to an array
    $answers = (array) $data->answers;
    $data = (array) $data;
    $data['answers'] = $answers;
    $totalVotes = array_sum($data['answers']);

    if ($_POST['vote']) {
        if (in_array($_POST['vote'], array_keys($data['answers']))) {
            // increase the selected answer by 1
            $data['answers'][$_POST['vote']]++;
            // save data to file // TODO the file permission is set to 666, we need a better solution
            $fp = fopen("./" . $dayOfYear . "json", "w");
            fwrite($fp, json_encode($data));
            fclose($fp);
        }
        // TODO: if it voted for something that does not exist, we log the answer and the IP address and timestamp
    }

    require "./template.php";


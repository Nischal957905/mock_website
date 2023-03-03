<?php
    // Problem: Bank account numbers should not have a comma at the beginning or at the end.
    // If there is a comma which is at some place other than the beginning or at the end,
    // then separate the distinct account numbers.

    $bankAccountNumbers = [',1029129','190291','190292,190293','1029194,','190294,190295'];
    echo 'Unformatted: ';
    print_r($bankAccountNumbers);
    echo '<br>';
    echo "\r\n";
    $formattedBankAccountNumbers = ['1029129','190291','190292','190293','1029194','190294','190295'];
    echo 'Required: ';
    print_r($formattedBankAccountNumbers);

    echo "\r\n";

    $output = [];

    // SOLUTION CODE HERE
    for($i=0; $i<sizeof($bankAccountNumbers); $i++ ){
        //Firstly using the trim function to remove the first and last place commas.
        $subSortedAccount = trim($bankAccountNumbers[$i],',');
        //Then using the explode function to seperate each trimmed element of the array on basis of comma as a seperate element.
        $seperatedAccount = explode(',',$subSortedAccount);
        //Finally storing..
        for($j = 0; $j < sizeof($seperatedAccount); $j++){
            $output[] = $seperatedAccount[$j];
        }
    }

    echo '<br>';
    echo 'Final: ';
    print_r($output);

    

    echo "\r\n";

    if($output === $formattedBankAccountNumbers){
        echo 'SOLVED!!';
    }
    else{
        echo 'Not solved yet.';
    }
?>

<?php 
if(isset($_POST['pay']))
{
    $email = $_POST['email'];
    $amount = $_POST['amount'];
// MTN, TIGO, AIRTEL, and VODAFONE
    //* Prepare our rave request
    $request = [
        'tx_ref' => time(),
        'amount' => $amount,
        'currency' => 'UGX',
        // "network"=>"VODAFONE",
        "phone_number"=>"256785557587",
    //    "client_ip"=>"154.123.220.1",
   
        'payment_options' => 'card',
        'redirect_url' => 'http://localhost/openbrook/process.php',
        'customer' => [
            'email' => $email,
            'name' => 'alfred'
        ],
        'meta' => [
            'price' => $amount
        ], 
        'customizations' => [
            'title' => 'Loan Payment ',
            'description' => 'Loan Payment to Openbrook limited'
        ]
    ];

    //* Ca;; f;iterwave emdpoint
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',   
    // CURLOPT_URL => 'https://api.flutterwave.com/v3/charges?type=mobile_money_uganda', 
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($request),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer FLWSECK_TEST-723f1df37c2341965123d79b4ee5015e-X',
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    // echo '<pre>';
    // echo $response;

    // echo '</pre>';


    $res = json_decode($response);
    if($res->status == 'success')
    {
        $link = $res->data->link;
        header('Location: '.$link);
    }
    else
    {
        echo 'We can not process your payment';
    }
}

?>
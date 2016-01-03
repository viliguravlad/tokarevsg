<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use SoapClient;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Client as Client;
use App\Models\ActivityLog as ActivityLog;

class SendController extends Controller
{
    public function getSingle() {
        if(\Auth::guest())
        {
            return redirect('auth/login');
        }

        return view('send/single');
    }

    public function getMultiple() {
        if(\Auth::guest())
        {
            return redirect('auth/login');
        }

        return view('send/multiple');
    }

    public function postSingle(Request $request) {

        //try{


        //$value = $request->session()->get('cardNo');
        /*
        |
        | Getting user`s card number
        |
        */
        $userInfo = array();
        foreach(\Input::all() as $key=>$value)
        {
            $userInfo[$key]=$value;
        }
            //var_dump($userInfo);
        
        $cardID = $userInfo['cardNo'];
        $nowPoints = $userInfo['nowPoints'];
            //echo $cardID;
            //echo $nowPoints;

        /*
        |
        | Connecting to the turbosms api via soap connection
        |
        */
        $soapClient = new SoapClient ('http://turbosms.in.ua/api/wsdl.html'); 
        $auth = array( 
            'login' => 'bandson', 
            'password' => '031194vela' 
        ); 
        $result = $soapClient->Auth ($auth); 
            //echo $result->AuthResult . ' ';

        /*
        |
        | Getting data from the database and creating message
        |
        */
        if(!Client::find($cardID))
        {
            return redirect('/send/single')->withErrors([
                'cardID' => 'Пользователя с данным номером карты не существует!',
                ]);
        }

        $client = Client::find($cardID);
        $client->nowPoints = $nowPoints;
        $client->allPoints = $client->allPoints + $nowPoints;
        
        // If we add points we also change overallPoints, if not - we do not change it
        if($nowPoints > 0) {
            $client->overallPoints = $client->overallPoints + $nowPoints;
        }

        // Change discount value
        if($client->overallPoints > 0 && $client->overallPoints < 1000) {
            $client->discount = 0;
        }
        else if($client->overallPoints >= 1000 && $client->overallPoints < 5000) {
            $client->discount = 10;
        }
        else if($client->overallPoints >= 5000 && $client->overallPoints < 10000) {
            $client->discount = 15;
        }
        else if($client->overallPoints >= 10000) {
            $client->discount = 20;
        }

        // Save changes
        $client->save();
            //echo $client->allPoints;

        // Zeroing nowPoints
        $client->nowPoints = 0;
        $client->save();
            //echo $client;

        $m = '';
        $m = (($client->state == "male") ? 'Shanovnyi ' : 'Shanovna ') . $client->lastName .' ' . $client->firstName . '! Zmina baliv: ' . $nowPoints . '. Vash zagalnyi balans: ' . $client->allPoints . '. Vasha procentna skydka - ' . $client->discount . '%.';

        $sms = array( 
            'sender' => 'Bandson', 
            'destination' => $client->mobNum, 
            'text' => $m
            );
            var_dump($sms);
            die;

        /*
        |
        | Sending SMS
        |
        */
        //$res=$client->SendSMS($sms);
        //echo $res->SendSMSResult->ResultArray[0] . '
        //';

        /*
        |
        | Putting activity into log
        |
        */
        $activityToLog = new ActivityLog;
        $activityToLog->activity = "Sent report! Turbosms Login: " . $sms['sender'] . ". Destination: " . $sms['destination'] . ". Message: " . $sms['text'];
        $activityToLog->user = \Auth::user()->name;
        $activityToLog->save();

        \Session::flash('messageSentSingle', 'Отчет отправлен!');
        return redirect('/send/single');

        //}
        /*catch(\Exception $e)
        {
            \Session::flash('messageSentSingleFail', $e->value());
            return redirect('/send/single');
        }*/
    }

    public function postMultiple() {
        
        /*
        |
        | Getting information from user
        |
        */
        $userInfo = array();
        foreach(\Input::all() as $key=>$value)
        {
            $userInfo[$key]=$value;
        }
            //var_dump($userInfo);
        $message = $userInfo['holidayText'];
        $state = $userInfo['state'];
        $spamOrClient = $userInfo['spamOrClient'];
            //echo $message;
            //echo $state;
            //echo $spamClient;
    
        /*
        |
        | Connecting to the turbosms api via soap connection
        |
        */
        $client = new SoapClient ('http://turbosms.in.ua/api/wsdl.html'); 
        $auth = array( 
            'login' => 'bandson', 
            'password' => '031194vela' 
        ); 
        $result = $client->Auth ($auth); 
            //echo $result->AuthResult . ' ';
        
        /*
        |
        | Setting appropriate data
        |
        */
        $ruleMaleClient = ['state' => 'male', 'spamOrClient' => 'client'];
        $ruleMaleSpam = ['state' => 'male', 'spamOrClient' => 'spam'];
        $ruleMaleAll = ['state' => 'male'];
        $ruleFemaleClient = ['state' => 'female', 'spamOrClient' => 'client'];
        $ruleFemaleSpam = ['state' => 'female', 'spamOrClient' => 'spam'];
        $ruleFemaleAll = ['state' => 'female'];
        $ruleAllClient = ['spamOrClient' => 'client'];
        $ruleAllSpam = ['spamOrClient' => 'spam'];
            
        if ($state == "male")
        {
            $str = '';
            if($spamOrClient == "spam")
            {
                $client = Client::where($ruleMaleSpam)->get();
                    //echo $client;
            }
            else if($spamOrClient == "client")
            {
                $client = Client::where($ruleMaleClient)->get();
                    //echo $client;
            }
            else if($spamOrClient == "spCl")
            {
                $client = Client::where($ruleMaleAll)->get();
                    //echo $client;
            }
                                    
            foreach($client as $row)
            {
                $str = $str . ',' . $row->mobNum;
            }
            $telephones = substr($str, 1);
                //echo $telephones;
        }
        else if ($state == "female")
        {
            $str = '';
            if($spamOrClient == "spam")
            {
                $client = Client::where($ruleFemaleSpam)->get();
                    //echo $client;
            }
            else if($spamOrClient == "client")
            {
                $client = Client::where($ruleFemaleClient)->get();
                    //echo $client;
            }
            else if($spamOrClient == "spCl")
            {
                $client = Client::where($ruleFemaleAll)->get();
                    //echo $client;
            }
                                    
            foreach($client as $row)
            {
                $str = $str . ',' . $row->mobNum;
            }
            $telephones = substr($str, 1);
                //echo $telephones;
        }
        else if ($state == "all")
        {
            $str = '';
            if($spamOrClient == "spam")
            {
                $client = Client::where($ruleAllSpam)->get();
                    //echo $client;
            }
            else if($spamOrClient == "client")
            {
                $client = Client::where($ruleAllClient)->get();
                    //echo $client;
            }
            else if($spamOrClient == "spCl")
            {
                $client = Client::all();
                    //echo $client;
            }
                                    
            foreach($client as $row)
            {
                $str = $str . ',' . $row->mobNum;
            }
            $telephones = substr($str, 1);
                //echo $telephones;
        }
        

        $sms = array( 
            'sender' => 'Bandson', 
            'destination' => $telephones, 
            'text' => $message
        );
            //var_dump($sms);
        
        /*
        |
        | Sending SMS
        |
        */
        //$res=$client->SendSMS($sms);
        //echo $res->SendSMSResult->ResultArray[0] . '
            //';

        /*
        |
        | Putting activity into log
        |
        */
        $activityToLog = new ActivityLog;
        $activityToLog->activity = "Sent multiple SMS! Turbosms Login: " . $sms['sender'] . ". Destination: " . $sms['destination'] . ". Message: " . $sms['text'];
        $activityToLog->user = \Auth::user()->name;
        $activityToLog->save();

        \Session::flash('messageSentMult', 'Сообщения отправлены!');
        return redirect('/send/multiple');
    }
}
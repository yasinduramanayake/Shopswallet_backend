<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\SmsGateway;
use Exception;
use LVR\Colour\Hex;

class AppSettingsLivewire extends BaseLivewireComponent
{

    // App settings
    public $appName;
    public $enableOTP;
    public $enableOTPLogin;
    public $otpGateway;
    public $appCountryCode;
    public $enableGoogleDistance;
    public $enableSingleVendor;
    public $enableMultipleVendorOrder;
    public $enableGroceryMode;
    public $enableReferSystem;
    public $enableChat;
    public $enableDriverTypeSwitch;
    public $enableParcelVendorByLocation;
    public $enableOrderTracking;
    public $enableUploadPrescription;
    public $referRewardAmount;
    public $enableParcelMultipleStops;
    public $maxParcelStops;
    public $clearFirestore;
    public $enableNumericOrderCode;
    public $orderVerificationType;
    public $vendorsHomePageListCount;
    public $partnersCanRegister;
    public $enableFatchByLocation;

    //login
    public $googleLogin;
    public $appleLogin;
    public $facebbokLogin;
    public $qrcodeLogin;
    public $auto_create_social_account;


    //colors
    public $accentColor;
    public $primaryColor;
    public $primaryColorDark;
    public $onboarding1Color;
    public $onboarding2Color;
    public $onboarding3Color;
    //
    public $onboardingIndicatorDotColor;
    public $onboardingIndicatorActiveDotColor;
    public $openColor;
    public $closeColor;
    public $deliveryColor;
    public $pickupColor;
    public $ratingColor;
    public $pendingColor;
    public $preparingColor;
    public $enrouteColor;
    public $failedColor;
    public $cancelledColor;
    public $deliveredColor;
    public $successfulColor;


    // driver releated
    public $enableProofOfDelivery;
    public $enableDriverWallet;
    public $alertDuration;
    public $driverWalletRequired;
    public $vendorEarningEnabled;
    public $driverSearchRadius;
    public $maxDriverOrderAtOnce;
    public $maxDriverOrderNotificationAtOnce;
    public $clearRejectedAutoAssignment;
    public $emergencyContact;
    public $distanceCoverLocationUpdate;
    public $timePassLocationUpdate;
    public $bannerHeight;
    public $allowVendorCreateDrivers;
    public $showVendorTypeImageOnly;
    public $statuses = [];
    public $autoassignmentStatus;
    public $systemTypes = [
        [
            "id" => 0,
            "name" => "Old",
        ], [
            "id" => 1,
            "name" => "New",
        ], [
            "id" => 2,
            "name" => "Firebase Cloud Function",
        ]
    ];
    public $autoassignmentsystem;

    //
    public $smsGateways = [];
    public $androidDownloadLink;
    public $iosDownloadLink;


    public function mount()
    {
        //sms gateways
        $this->smsGateways = ['None', 'Firebase'];
        //
        $mSmsGateways = SmsGateway::all()->pluck('slug')->toArray();
        foreach ($mSmsGateways as $smsGateway) {
            $this->smsGateways[] = $smsGateway;
        }



        $this->appName = setting('appName', env('APP_NAME'));
        $this->enableOTP = (bool) setting('enableOTP');
        $this->enableOTPLogin = (bool) setting('enableOTPLogin');
        $this->otpGateway = setting('otpGateway');
        $this->appCountryCode = setting('appCountryCode', 'GH');
        $this->enableGoogleDistance = (bool) setting('enableGoogleDistance', 1);
        $this->enableSingleVendor = (bool) setting('enableSingleVendor');
        $this->enableMultipleVendorOrder = (bool) setting('enableMultipleVendorOrder');
        $this->enableProofOfDelivery = (bool) setting('enableProofOfDelivery');
        $this->orderVerificationType = setting('orderVerificationType', 'none');
        $this->enableDriverWallet = (bool) setting('enableDriverWallet');
        $this->driverWalletRequired = (bool) setting('driverWalletRequired');
        $this->vendorEarningEnabled = (bool) setting('vendorEarningEnabled');
        $this->clearFirestore = (bool) setting('clearFirestore');
        $this->enableNumericOrderCode = (bool) setting('enableNumericOrderCode');
        $this->vendorsHomePageListCount = (int) setting('vendorsHomePageListCount', 15);
        $this->enableFatchByLocation = (bool) setting('enableFatchByLocation');

        //login
        $this->googleLogin = (bool) setting('googleLogin');
        $this->appleLogin = (bool) setting('appleLogin');
        $this->facebbokLogin = (bool) setting('facebbokLogin');
        $this->qrcodeLogin = (bool) setting('qrcodeLogin');
        $this->auto_create_social_account = (bool) setting('auto_create_social_account', 0);


        $this->alertDuration = (int) setting('alertDuration', 15);
        $this->enableGroceryMode = (bool) setting('enableGroceryMode');
        $this->enableReferSystem = (bool) setting('enableReferSystem');
        $this->enableChat = (bool) setting('enableChat');
        $this->enableOrderTracking = (bool) setting('enableOrderTracking', true);
        $this->enableUploadPrescription = (bool) setting('enableUploadPrescription', true);
        $this->enableParcelVendorByLocation = (bool) setting('enableParcelVendorByLocation');
        $this->referRewardAmount = (float) setting('referRewardAmount');
        $this->enableParcelMultipleStops = (bool) setting('enableParcelMultipleStops');
        $this->maxParcelStops = (float) setting('maxParcelStops');

        //
        $this->enableDriverTypeSwitch = (bool) setting('enableDriverTypeSwitch', 0);
        $this->driverSearchRadius = (float) setting('driverSearchRadius', 10);
        $this->maxDriverOrderAtOnce = (int) setting('maxDriverOrderAtOnce', 1);
        $this->maxDriverOrderNotificationAtOnce = (int) setting('maxDriverOrderNotificationAtOnce', 1);
        $this->clearRejectedAutoAssignment = (int) setting('clearRejectedAutoAssignment', 0);
        $this->emergencyContact = setting('emergencyContact', "911");
        $this->distanceCoverLocationUpdate = setting('distanceCoverLocationUpdate', "10");
        $this->timePassLocationUpdate = setting('timePassLocationUpdate', "10");
        $this->bannerHeight = setting('bannerHeight', "150");
        $this->allowVendorCreateDrivers = (bool) setting('allowVendorCreateDrivers');
        $this->showVendorTypeImageOnly = (bool) setting('showVendorTypeImageOnly');
        $this->partnersCanRegister = (bool) setting('partnersCanRegister', true);
        $this->autoassignmentStatus =  setting('autoassignment_status', "ready");
        $this->autoassignmentsystem =  setting('autoassignmentsystem', 0);

        //
        $this->accentColor = setting('appColorTheme.accentColor', '#64bda1');
        $this->primaryColor = setting('appColorTheme.primaryColor', '#21a179');
        $this->primaryColorDark = setting('appColorTheme.primaryColorDark', '#146149');
        //
        $this->onboarding1Color = setting('appColorTheme.onboarding1Color', '#F9F9F9');
        $this->onboarding2Color = setting('appColorTheme.onboarding2Color', '#F6EFEE');
        $this->onboarding3Color = setting('appColorTheme.onboarding3Color', '#FFFBFC');
        //
        $this->onboardingIndicatorDotColor = setting('appColorTheme.onboardingIndicatorDotColor', '#30C0D9');
        $this->onboardingIndicatorActiveDotColor = setting('appColorTheme.onboardingIndicatorActiveDotColor', '#21a179');
        $this->openColor = setting('appColorTheme.openColor', '#00FF00');
        $this->closeColor = setting('appColorTheme.closeColor', '#FF0000');
        $this->deliveryColor = setting('appColorTheme.deliveryColor', '#FFBF00');
        $this->pickupColor = setting('appColorTheme.pickupColor', '#0000FF');
        $this->ratingColor = setting('appColorTheme.ratingColor', '#FFBF00');
        //
        $this->pendingColor = setting('appColorTheme.pendingColor', '#0099FF');
        $this->preparingColor = setting('appColorTheme.preparingColor', '#0000FF');
        $this->enrouteColor = setting('appColorTheme.enrouteColor', '#00FF00');
        $this->failedColor = setting('appColorTheme.failedColor', '#FF0000');
        $this->cancelledColor = setting('appColorTheme.cancelledColor', '#808080');
        $this->deliveredColor = setting('appColorTheme.deliveredColor', '#01A368');
        $this->successfulColor = setting('appColorTheme.successfulColor', '#01A368');
        //
        $this->androidDownloadLink = setting('androidDownloadLink');
        $this->iosDownloadLink = setting('iosDownloadLink');

        //
        $this->statuses = Order::getPossibleStatues();
    }

    public function render()
    {

        $this->mount();
        return view('livewire.settings.app-settings');
    }


    public function saveAppSettings()
    {

        $this->validate([
            "appName" => "required|string",
            'accentColor' => ['sometimes', 'nullable', new Hex],
            'primaryColor' => ['sometimes', 'nullable', new Hex],
            'primaryColorDark' => ['sometimes', 'nullable', new Hex],
        ]);

        try {

            //make the phone column nullable
            if ($this->auto_create_social_account) {
                \Schema::table("users", function ($table) {
                    $table->string('phone')->nullable()->change();
                });
            }
            $this->isDemo();
            $appSettings = [
                'androidDownloadLink' =>  $this->androidDownloadLink,
                'iosDownloadLink' =>  $this->iosDownloadLink,
                'appName' =>  $this->appName,
                'otpGateway' =>  $this->otpGateway,
                'enableOTPLogin' =>  $this->enableOTPLogin,
                'appCountryCode' =>  $this->appCountryCode,
                'enableGoogleDistance' =>  $this->enableGoogleDistance,
                'enableSingleVendor' =>  $this->enableSingleVendor,
                'enableMultipleVendorOrder' =>  $this->enableMultipleVendorOrder,
                'enableProofOfDelivery' =>  $this->enableProofOfDelivery,
                'orderVerificationType' =>  $this->orderVerificationType,
                'enableDriverWallet' =>  $this->enableDriverWallet,
                'driverWalletRequired' =>  $this->driverWalletRequired,
                'vendorEarningEnabled' =>  $this->vendorEarningEnabled,
                'vendorsHomePageListCount' =>  $this->vendorsHomePageListCount,
                'enableFatchByLocation' =>  $this->enableFatchByLocation,
                'enableNumericOrderCode' =>  $this->enableNumericOrderCode,

                //logins
                'googleLogin' =>  $this->googleLogin,
                'appleLogin' =>  $this->appleLogin,
                'facebbokLogin' =>  $this->facebbokLogin,
                'qrcodeLogin' =>  $this->qrcodeLogin,
                'auto_create_social_account' =>  $this->auto_create_social_account,


                'clearFirestore' =>  $this->clearFirestore,
                //default 15seconds
                'enableDriverTypeSwitch' =>  $this->enableDriverTypeSwitch,
                'alertDuration' =>  $this->alertDuration ?? 15,
                //default 10km radius
                'driverSearchRadius' =>  $this->driverSearchRadius ?? 10,
                //max driver order at once
                'maxDriverOrderAtOnce' =>  $this->maxDriverOrderAtOnce ?? 1,
                'maxDriverOrderNotificationAtOnce' =>  $this->maxDriverOrderNotificationAtOnce ?? 1,
                'clearRejectedAutoAssignment' =>  $this->clearRejectedAutoAssignment ?? 0,
                'emergencyContact' =>  $this->emergencyContact,
                'distanceCoverLocationUpdate' =>  $this->distanceCoverLocationUpdate,
                'timePassLocationUpdate' =>  $this->timePassLocationUpdate,
                'bannerHeight' =>  $this->bannerHeight,
                'allowVendorCreateDrivers' =>  $this->allowVendorCreateDrivers,
                'showVendorTypeImageOnly' =>  $this->showVendorTypeImageOnly,
                'partnersCanRegister' =>  $this->partnersCanRegister,
                'autoassignment_status' =>  $this->autoassignmentStatus,
                'autoassignmentsystem' =>  $this->autoassignmentsystem,

                'enableGroceryMode' =>  $this->enableGroceryMode,
                'enableReferSystem' =>  $this->enableReferSystem,
                'enableChat' =>  $this->enableChat,
                'enableOrderTracking' =>  $this->enableOrderTracking,
                'enableUploadPrescription' =>  $this->enableUploadPrescription,
                'enableParcelVendorByLocation' =>  $this->enableParcelVendorByLocation,
                'referRewardAmount' =>  $this->referRewardAmount,
                'referRewardAmount' =>  $this->referRewardAmount,
                'enableParcelMultipleStops' =>  $this->enableParcelMultipleStops,
                'maxParcelStops' =>  $this->maxParcelStops,
                'appColorTheme' => [
                    "accentColor" => $this->accentColor,
                    "primaryColor" => $this->primaryColor,
                    "primaryColorDark" => $this->primaryColorDark,
                    //
                    "onboarding1Color" => $this->onboarding1Color,
                    "onboarding2Color" => $this->onboarding2Color,
                    "onboarding3Color" => $this->onboarding3Color,
                    //
                    "onboardingIndicatorDotColor" => $this->onboardingIndicatorDotColor,
                    "onboardingIndicatorActiveDotColor" => $this->onboardingIndicatorActiveDotColor,
                    "openColor" => $this->openColor,
                    "closeColor" => $this->closeColor,
                    "deliveryColor" => $this->deliveryColor,
                    "pickupColor" => $this->pickupColor,
                    "ratingColor" => $this->ratingColor,
                    "pendingColor" => $this->pendingColor,
                    "preparingColor" => $this->preparingColor,
                    "enrouteColor" => $this->enrouteColor,
                    "failedColor" => $this->failedColor,
                    "cancelledColor" => $this->cancelledColor,
                    "deliveredColor" => $this->deliveredColor,
                    "successfulColor" => $this->successfulColor,
                ]
            ];

            // update the site name
            setting($appSettings)->save();



            $this->showSuccessAlert(__("App Settings saved successfully!"));
            $this->reset();
        } catch (Exception $error) {
            $this->showErrorAlert($error->getMessage() ?? __("App Settings save failed!"));
        }
    }
}

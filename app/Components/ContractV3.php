<?php

namespace App\Components;

use App\Models\Farmer;
use App\Models\Harvest;
use App\Models\HarvestExpertise;
use App\Models\Laboratory;
use App\Models\Tester;
use App\Models\Sponsor;
use App\Models\Pharmacy;
use App\Models\Certifier;
use Graze\GuzzleHttp\JsonRpc\Client;
use Illuminate\Support\Str;

class ContractV3
{

    const GAZ = 4700000;

    /**
     * @var Ethereum
     */
    protected $eth;
    protected $address;
    protected $convertHexToDecimal = true;
    protected $userAddress;
    protected $userSecretPhrase;

    public function __construct()
    {
        $this->eth = app('eth');
        $this->address = setting('eth.supply_contract_address_new');
        $this->userAddress = setting('eth.coinbase_address');
        $this->userSecretPhrase = setting('eth.coinbase_secret_phrase');
    }

    public function getAddress(){
        return $this->address;
    }

    private function exec($data){

        $this->eth->personal_unlockAccount($this->userAddress, $this->userSecretPhrase, 20);

        $result = $this->eth->eth_sendTransaction([
            'from' => $this->userAddress,
            'to' => $this->address,
            'data' => $data,
            'gas' => '0x'.dechex(static::GAZ)
        ]);

        $this->eth->personal_lockAccount($this->userAddress);

        return $result;

    }

    protected $functions = [
        'setGrower' => ['0x97a5a8c1', ['address', 'string']],
        'setLab' => ['0x169c2b9b', ['address', 'string']],
          'setTester' => ['0x269c2b9b', ['address', 'string']],
            'setSponsor' => ['0x369c2b9c', ['address', 'string']],
              'setCertifier' => ['0x469c2b9d', ['address', 'string']],
                'setPharm' => ['0x569c2b9e', ['address', 'string']],

        'setRawMaterial' => ['0x0e7805a6', ['bytes32', 'address', 'string']],
        'setExpertise' => ['0x8d010d74', ['bytes32', 'bytes32', 'address', 'string']],

        'growers' => ['0x94ef3969', ['address']],
        'labs' => ['0x277d5891', ['address']],
        'testers' => ['0x377d5891', ['address']],
        'certifiers' => ['0x477d5891', ['address']],
        'sponsors' => ['0x577d5891', ['address']],
        'pharms' => ['0x677d5891', ['address']],

        'expertises' => ['0xa44e1a8c', ['bytes32']],
        'rawMaterials' => ['0x1fbe9c51', ['bytes32']],

        'changeOwner' => ['0xa6f9dae1', ['address']],
    ];

    #  -Farmer   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -

    public function putFarmer(Farmer $farmer){

        $storedObject = Farmer::blockChainFormat($farmer);

        return $this->exec(
            $this->eth->prepareData(
                'setGrower',
                [
                    $farmer->eth_address,
                    json_encode($storedObject),
                ]
            )
        );

    }
    #  -Tester
        public function putTester(Tester $tester){

            $storedObject = Tester::blockChainFormat($tester);

            return $this->exec(
                $this->eth->prepareData(
                    'setTester',
                    [
                        $tester->eth_address,
                        json_encode($storedObject),
                    ]
                )
            );

        }

  #  -Sponsor

            public function putSponsor(Sponsor $sponsor){

                $storedObject = Sponsor::blockChainFormat($sponsor);

                return $this->exec(
                    $this->eth->prepareData(
                        'setSponsor',
                        [
                            $sponsor->eth_address,
                            json_encode($storedObject),
                        ]
                    )
                );

            }


  #  -Certifier
                public function putCertifier(Certifier $sponsor){

                    $storedObject = Certifier::blockChainFormat($sponsor);

                    return $this->exec(
                        $this->eth->prepareData(
                            'setCertifier',
                            [
                                $sponsor->eth_address,
                                json_encode($storedObject),
                            ]
                        )
                    );

                }

    public function putLaboratory(Laboratory $laboratory){

        $storedObject = Laboratory::blockChainFormat($laboratory);

        return $this->exec(
            $this->eth->prepareData(
                'setLab',
                [
                    $laboratory->eth_address,
                    json_encode($storedObject),
                ]
            )
        );

    }

    public function putPharmacy(Pharmacy $pharmacy){

        $storedObject = Pharmacy::blockChainFormat($pharmacy);

        return $this->exec(
            $this->eth->prepareData(
                'setPharm',
                [
                    $pharmacy->eth_address,
                    json_encode($storedObject),
                ]
            )
        );

    }


    public function putHarvest(Harvest $harvest){

        $storedObject = Harvest::blockChainFormat($harvest);

        return $this->exec(
            $this->eth->prepareData(
                'setRawMaterial',
                [
                    $harvest->uid,
                    $harvest->eth_address,
                    json_encode($storedObject),
                ]
            )
        );

    }

    public function putExpertise(HarvestExpertise $exp){

        $storedObject = HarvestExpertise::blockChainFormat($exp);

        return $this->exec(
            $this->eth->prepareData(
                'setExpertise',
                [
                    (string) $exp->uid,
                    (string) $exp->harvest_uid, # can be NULL
                    (string) $exp->eth_address_lab,
                    json_encode($storedObject),
                ]
            )
        );

    }

    protected function _stringDecode($str){
        $stringLengthBin = substr($str,65, 65);
        $stringLength = hexdec($stringLengthBin);
        $result = '0x'.substr($str, 130, $stringLength*2);
        return $this->eth->hexToStr($result);
    }

    protected function _requestContractData($varMethodHash, array $params){

        return app('eth')->eth_call([
            'to' => $this->address,
            'data' => $this->eth->prepareData($varMethodHash, $params)
        ], 'pending');

    }

    protected function _requestFor($method, array $params){

        return json_decode(
            $result = $this->_stringDecode(
                $this->_requestContractData($method, $params)
            ),
            true
        );

    }

    public function getExpertise($uid)
    {

        return $this->_requestFor('expertises', [$uid]);

    }

    public function getLab($address){

        return $this->_requestFor('labs', [$address]);

    }


        public function getPharm($address){

            return $this->_requestFor('pharms', [$address]);

        }

    public function getHarvest($uid){

        return $this->_requestFor('rawMaterials', [$uid]);

    }
    public function getFarmer($address){

        return $this->_requestFor('growers', [$address]);

    }

    public function getTester($address){

        return $this->_requestFor('testers', [$address]);

    }

    public function getSponsor($address){

        return $this->_requestFor('sponsors', [$address]);

    }


        public function getCertifier($address){

            return $this->_requestFor('certifiers', [$address]);

        }

    public function getLogs($signature = null, $id = null)
    {
        $topics = [];
        $outputData = [];

        if ($signature) {
            $signatureList = $this->getLogSignatures();
            if (in_array($signature, array_keys($signatureList))) {
                $signature = $signatureList[$signature];

                //$topics[] = $this->eth->web3_sha3('0x'.bin2hex($signature));
                $topics[] = $signature;
            }
        }
        if ($id) {
            $topics[] = '0x'.$this->eth->convertParam($id);
        }

        $logs = $this->eth->eth_getLogs([
            'fromBlock' => '0x1',
            'toBlock' => 'latest',
            'address' => $this->address,
            'topics' => $topics
        ]);

        if ($logs) {

            $signatureHashes = array_flip($this->getLogSignatures());
            foreach ($logs as $log) {
                $topics = $log['topics'];
                $data = $log['data'];
                if ($data) {
                    $stringLengthBin = substr($data,65, 65);
                    $stringLength = hexdec($stringLengthBin);
                    $data = '0x'.substr($data, 130, $stringLength*2);
                    $data = $this->eth->hexToStr($data);
                    $outputLog = json_decode($data, true);
                    if (isset($topics[0]) && isset($signatureHashes[$topics[0]])) {
                        $outputLog['signature'] = $signatureHashes[$topics[0]];
                    } else {
                        $outputLog['signature'] = 'unknown';
                    }
                    $outputLog['logInfo'] = $log;
                    $outputData[] = $outputLog;
                }
            }
        }

        return collect($outputData)->reverse();
    }

    public function getLogSignatures()
    {
        return [
            //'grower' => 'Grower(address,string)',
            'grower' => '0x5df01dfbc6a3d8ff75be7eefe3e3272927b561cb0b837003e2507141cf695b00',
            //'lab' => 'Lab(address,string)',
            'lab' => '0xd1fbd84079957408e9520ca7badddaf6b50d97bcbcca504224f4f68eb3f843f3',
            //'expertise' => 'Expertise(bytes32,bytes32,address,string)',
            'expertise' => '0x31c623dbce18369cfd09150263fed264f1664da6650d4fc1a3af23ce442aa135',
            //'rawMaterial' => 'RawMaterial(bytes32,address,string)',
            'rawMaterial' => '0xd6db2520747d56a3a7500efbf6dc90a63983c520cdfe38193c78f2fc3472e0ee',
              //'Pharm' => 'Pharm(address,string)',
              'pharm' => '0xd1fbd84079957408e9520ca7badddaf6b50d97bcbcca504224f4f68eb3f843f3',
              'tester' => '0xd1fbd84079957408e9520ca7badddaf6b50d97bcbcca504224f4f68eb3f843f3',
              'sponsor' => '0xd1fbd84079957408e9520ca7badddaf6b50d97bcbcca504224f4f68eb3f843f3',
              'pharm' => '0xd1fbd84079957408e9520ca7badddaf6b50d97bcbcca504224f4f68eb3f843f3',
              'certifier' => '0xd1fbd84079957408e9520ca7badddaf6b50d97bcbcca504224f4f68eb3f843f3',

        ];
    }

    protected function withMapper($name, array $arguments = []){

        list($methodHash, $dataMapper) = $this->functions[$name];

        return $this->eth->dataMapper($methodHash, $dataMapper, $arguments);

    }
    public function getFunctions( $funcName )
    {
        return $this->functions[ $funcName ];
    }


}

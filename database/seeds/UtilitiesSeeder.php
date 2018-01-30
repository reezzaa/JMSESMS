<?php

use Illuminate\Database\Seeder;
use App\ClientIDUtil;
use App\ContractIDUtil;
use App\InvoiceIDUtil;
use App\OrIDUtil;
use App\Recoupment;
use App\Retention;
use App\PaymentMode;
use App\Tax;
use App\Fee;

class UtilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ClientIDUtil::create([
                'strClientIDUtil' => 'Client0000000',
            ]);
        ContractIDUtil::create([
                'strContractIDUtil' => 'Contract0000000',
            ]);
        InvoiceIDUtil::create([
                'strInvoiceIDUtil' => 'Inv0000000',
            ]);
        OrIDUtil::create([
                'strOrIDUtil' => 'OR0000000',
            ]);
        Recoupment::create([
                'RecValue' => '30',
                'status'=>'1',
      			'todelete'=>'1',
            ]);
        Retention::create([
                'RetValue' => '10',
                'status'=>'1',
      			'todelete'=>'1',
            ]);
        Tax::create([
                'TaxValue' => '12',
                'status'=>'1',
      			'todelete'=>'1',
            ]);
        PaymentMode::create([
                'ModeValue'=>'10',
      			'status'=>'1',
      			'todelete'=>'1',
            ]);
        PaymentMode::create([
                'ModeValue'=>'20',
      			'status'=>'1',
      			'todelete'=>'1',
            ]);
        PaymentMode::create([
                'ModeValue'=>'30',
      			'status'=>'1',
      			'todelete'=>'1',
            ]);
        PaymentMode::create([
                'ModeValue'=>'40',
      			'status'=>'1',
      			'todelete'=>'1',
            ]);
        PaymentMode::create([
                'ModeValue'=>'50',
      			'status'=>'1',
      			'todelete'=>'1',
            ]);
        PaymentMode::create([
                'ModeValue'=>'60',
      			'status'=>'1',
      			'todelete'=>'1',
            ]);
        PaymentMode::create([
                'ModeValue'=>'70',
      			'status'=>'1',
      			'todelete'=>'1',
            ]);
        PaymentMode::create([
                'ModeValue'=>'80',
      			'status'=>'1',
      			'todelete'=>'1',
            ]);
        PaymentMode::create([
                'ModeValue'=>'90',
      			'status'=>'1',
      			'todelete'=>'1',
            ]);
        PaymentMode::create([
                'ModeValue'=>'100',
      			'status'=>'1',
      			'todelete'=>'1',
            ]);
        Fee::create([
                'FeeDesc'=>'Service Markup',
      			'FeeValue'=>'18',
      			'todelete'=>'1',
      			'status'=>'1',
            ]);
        Fee::create([
                'FeeDesc'=>'Handling Fee',
      			'FeeValue'=>'4',
      			'todelete'=>'1',
      			'status'=>'1',
            ]);
    }
}

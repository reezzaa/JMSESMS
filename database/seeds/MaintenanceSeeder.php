<?php

use Illuminate\Database\Seeder;
use App\Specialization;
use App\GroupUOM;
use App\DetailUOM;
use App\MaterialType;
use App\MaterialClass;
use App\Material;
use App\Equipment;
use App\Supplier;
use App\Bank;
use App\ServicesOffered;
use App\Miscellaneous;
use App\Rate;
use App\SpecRate;
use App\MatPrice;
class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Specialization::create([
           'SpecDesc'=>'Welding',
	      'rpd'=>'200',
	      'date'=>'2017-10-02',
	      'todelete'=>1,
	      'status'=>1,
            ]);
      SpecRate::create([
          'SpecID'=>1,
          'date'=>'2017-10-02',
          'up_rpd'=>200,
         ]);
    	Specialization::create([
           'SpecDesc'=>'Safety Officer',
	      'rpd'=>'418',
	      'date'=>'2018-01-02',
	      'todelete'=>1,
	      'status'=>1,
            ]);
      SpecRate::create([
          'SpecID'=>2,
          'date'=>'2018-01-02',
          'up_rpd'=>418,
         ]);
    	Specialization::create([
           'SpecDesc'=>'RT Technician',
	      'rpd'=>'420',
	      'date'=>'2017-11-02',
	      'todelete'=>1,
	      'status'=>1,
            ]);
      SpecRate::create([
          'SpecID'=>3,
          'date'=>'2017-11-02',
          'up_rpd'=>420,
         ]);
    	Specialization::create([
           'SpecDesc'=>'Supervisor',
	      'rpd'=>'480',
	      'date'=>'2018-01-20',
	      'todelete'=>1,
	      'status'=>1,
            ]);
      SpecRate::create([
          'SpecID'=>4,
          'date'=>'2018-01-20',
          'up_rpd'=>480,
         ]);
    	Specialization::create([
           'SpecDesc'=>'Semi-Skilled Worker',
	      'rpd'=>'150',
	      'date'=>'2018-01-20',
	      'todelete'=>1,
	      'status'=>1,
            ]);
      SpecRate::create([
          'SpecID'=>5,
          'date'=>'2018-01-20',
          'up_rpd'=>150,
         ]);
         GroupUOM::create([
           'GroupUOMText'=> 'Length',
      		'status'=> 1,
      		'todelete' => 1,
            ]);
         GroupUOM::create([
           'GroupUOMText'=> 'Weight',
      		'status'=> 1,
      		'todelete' => 1,
            ]);
         GroupUOM::create([
           'GroupUOMText'=> 'Not Applicable',
      		'status'=> 1,
      		'todelete' => 1,
            ]);
         GroupUOM::create([
           'GroupUOMText'=> 'Volume',
      		'status'=> 1,
      		'todelete' => 1,
            ]);
         DetailUOM::create([
           'GroupUOMID'=>1,
		   'DetailUOMText'=>'Meter',
		   'UOMUnitSymbol'=>'m',
		   'status'=>1,
		   'todelete'=>1,
            ]);
         DetailUOM::create([
           'GroupUOMID'=>2,
		   'DetailUOMText'=>'Kilogram',
		   'UOMUnitSymbol'=>'Kg',
		   'status'=>1,
		   'todelete'=>1,
            ]);
         DetailUOM::create([
           'GroupUOMID'=>3,
		   'DetailUOMText'=>'N/A',
		   'UOMUnitSymbol'=>'pc',
		   'status'=>1,
		   'todelete'=>1,
            ]);
         DetailUOM::create([
           'GroupUOMID'=>4,
		   'DetailUOMText'=>'Milliliter',
		   'UOMUnitSymbol'=>'ml',
		   'status'=>1,
		   'todelete'=>1,
            ]);
         DetailUOM::create([
           'GroupUOMID'=>4,
		   'DetailUOMText'=>'Liter',
		   'UOMUnitSymbol'=>'L',
		   'status'=>1,
		   'todelete'=>1,
            ]);
         Supplier::create([
           'SuppDesc'=>'JJJ',
          'todelete'=>1,
          'status'=>1,
            ]);
         Supplier::create([
           'SuppDesc'=>'Supplier A',
          'todelete'=>1,
          'status'=>1,
            ]);
         MaterialType::create([
           'MatTypeName'=>'Wood',
     		'todelete'=>1,
      		'status'=>1,
            ]);
         MaterialType::create([
           'MatTypeName'=>'Metal',
     		'todelete'=>1,
      		'status'=>1,
            ]);
         MaterialType::create([
           'MatTypeName'=>'Consumables',
     		'todelete'=>1,
      		'status'=>1,
            ]);
         MaterialType::create([
           'MatTypeName'=>'Fillers',
     		'todelete'=>1,
      		'status'=>1,
            ]);
         MaterialClass::create([
           'MatClassName'=>'Plywood',
      		'MatTypeID'=>1,
      		'todelete'=>1,
      		'status'=>1,
            ]);
         MaterialClass::create([
           'MatClassName'=>'Steel',
      		'MatTypeID'=>2,
      		'todelete'=>1,
      		'status'=>1,
            ]);
         MaterialClass::create([
           'MatClassName'=>'Liquid',
      		'MatTypeID'=>3,
      		'todelete'=>1,
      		'status'=>1,
            ]);
         MaterialClass::create([
           'MatClassName'=>'Gravel',
      		'MatTypeID'=>4,
      		'todelete'=>1,
      		'status'=>1,
            ]);
         Material::create([
           'MatClassID'=>1,
		    'MatUOM'=>1,
		    'MaterialName'=>'Narra Plywood',
		    'MaterialBrand'=>'',
		    'MaterialSize'=>'',
		    'MaterialColor'=>'',
		    'MaterialDimension'=>'',
        'MaterialUnitPrice'=>1000,
		    'SuppID'=>1,
		    'todelete'=>1,
        'status'=>1,
		    'date'=>'2018-02-01',
            ]);
         MatPrice::create([
          'MatID'=>1,
          'date'=>'2018-02-01',
          'up_mat'=>1000,
         ]);
         Material::create([
           'MatClassID'=>2,
		    'MatUOM'=>3,
		    'MaterialName'=>'Angle Bar',
		    'MaterialBrand'=>'',
		    'MaterialSize'=>'',
		    'MaterialColor'=>'',
		    'MaterialDimension'=>'4 x 4',
		    'MaterialUnitPrice'=>500,
        'SuppID'=>2,
		    'todelete'=>1,
		    'status'=>1,
        'date'=>'2018-02-01',
            ]);
         MatPrice::create([
          'MatID'=>2,
          'date'=>'2018-02-01',
          'up_mat'=>500,
         ]);
         Material::create([
           'MatClassID'=>3,
		    'MatUOM'=>5,
		    'MaterialName'=>'Acrylic Paint BRW',
		    'MaterialBrand'=>'Boysen',
		    'MaterialSize'=>'',
		    'MaterialColor'=>'Brown',
		    'MaterialDimension'=>'',
		    'MaterialUnitPrice'=>1000,
        'SuppID'=>1,
		    'todelete'=>1,
		    'status'=>1,
        'date'=>'2018-02-01',
            ]);
         MatPrice::create([
          'MatID'=>3,
          'date'=>'2018-02-01',
          'up_mat'=>1000,
         ]);
         Material::create([
           'MatClassID'=>3,
		    'MatUOM'=>5,
		    'MaterialName'=>'Acrylic Paint GR',
		    'MaterialBrand'=>'Boysen',
		    'MaterialSize'=>'',
		    'MaterialColor'=>'Green',
		    'MaterialDimension'=>'',
		    'MaterialUnitPrice'=>1000,
        'SuppID'=>2,
		    'todelete'=>1,
		    'status'=>1,
        'date'=>'2018-02-01',
            ]);
         MatPrice::create([
          'MatID'=>4,
          'date'=>'2018-02-01',
          'up_mat'=>1000,
         ]);
         Material::create([
           'MatClassID'=>4,
		    'MatUOM'=>2,
		    'MaterialName'=>'Gravel Sand',
		    'MaterialBrand'=>'',
		    'MaterialSize'=>'',
		    'MaterialColor'=>'',
		    'MaterialDimension'=>'',
		    'MaterialUnitPrice'=>500,
        'SuppID'=>1,
		    'todelete'=>1,
		    'status'=>1,
        'date'=>'2018-02-01',
            ]);
         MatPrice::create([
          'MatID'=>5,
          'date'=>'2018-02-01',
          'up_mat'=>500,
         ]);
         Equipment::create([
           'EquipName'=>'Welding Machines',
      		'EquipTypeDesc'=>'Machine',
      		'EquipLeaser'=>'',
      		'EquipKey'=>'099HSFR3',
     		 'EquipPrice'=>0,
     		 'todelete'=>1,
     		 'status'=>1,
     		 'rent'=>0,
            ]);
         Equipment::create([
           'EquipName'=>'Compact Excavator',
      		'EquipTypeDesc'=>'Excavator',
      		'EquipLeaser'=>'CAT',
      		'EquipKey'=>'913898FGH',
     		 'EquipPrice'=>10000,
     		 'todelete'=>1,
     		 'status'=>1,
     		 'rent'=>1,
            ]);
         
        Bank::create([
           'BankName'=>'Metrobank',
      		'todelete'=>1,
      		'status'=>1,
            ]);
        Bank::create([
           'BankName'=>'Eastwest',
      		'todelete'=>1,
      		'status'=>1,
            ]);
        Bank::create([
           'BankName'=>'UnionBank',
      		'todelete'=>1,
      		'status'=>1,
            ]);
        ServicesOffered::create([
           'ServiceOffName'=>'Installation of Hydraulic Collapsible Ladder',
      		'todelete'=>1,
      		'status'=>1,
            ]);
        ServicesOffered::create([
           'ServiceOffName'=>'General Steel Fabrication and Modification',
      		'todelete'=>1,
      		'status'=>1,
            ]);
        ServicesOffered::create([
           'ServiceOffName'=>'Repair',
      		'todelete'=>1,
      		'status'=>1,
            ]);
        ServicesOffered::create([
           'ServiceOffName'=>'Welding',
      		'todelete'=>1,
      		'status'=>1,
            ]);
        ServicesOffered::create([
           'ServiceOffName'=>'Metal Spraying',
      		'todelete'=>1,
      		'status'=>1,
            ]);
        ServicesOffered::create([
           'ServiceOffName'=>'Painting',
      		'todelete'=>1,
      		'status'=>1,
            ]);
        ServicesOffered::create([
           'ServiceOffName'=>'Testing and Commissioning of Units',
      		'todelete'=>1,
      		'status'=>1,
            ]);
        ServicesOffered::create([
           'ServiceOffName'=>'Instrumentation',
      		'todelete'=>1,
      		'status'=>1,
            ]);
        ServicesOffered::create([
           'ServiceOffName'=>'Isolation Works',
      		'todelete'=>1,
      		'status'=>1,
            ]);
		ServicesOffered::create([
           'ServiceOffName'=>'Mobilization',
      		'todelete'=>1,
      		'status'=>1,
            ]);
    Miscellaneous::create([
           'MiscDesc'=>'Transportation',
           'MiscValue'=>'5000',
          'todelete'=>1,
          'status'=>1,
            ]);
    Miscellaneous::create([
           'MiscDesc'=>'Allowance',
           'MiscValue'=>'7000',
          'todelete'=>1,
          'status'=>1,
            ]);
    Rate::create([
           'RateDesc'=>'Power Consumption',
           'RateValue'=>'20',
          'todelete'=>1,
          'status'=>1,
            ]);
    Rate::create([
           'RateDesc'=>'Water Consumption',
           'RateValue'=>'15',
          'todelete'=>1,
          'status'=>1,
            ]);
    }
}

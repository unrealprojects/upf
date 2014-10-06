<?php
namespace UpfSeeds;
/*** Add Params ***/
class ParamsSeeder extends \Seeder {
	public function run()
	{
        $Params = [
            ['title'=>'Эксплуатационная масса','min'=>100,'max'=>20000,'dimension'=>'кг.'],
            ['title'=>'Грузоподъёмность','min'=>10,'max'=>20000,'dimension'=>'кг.'],
            ['title'=>'Вместимость кузова','min'=>0.5,'max'=>100,'dimension'=>'м3'],
            ['title'=>'Мощьность двигателя','min'=>10,'max'=>1000,'dimension'=>'лс'],
            ['title'=>'Ширина гусениц','min'=>100,'max'=>500,'dimension'=>'мм'],
            ['title'=>'Скорость передвижения','min'=>100,'max'=>500,'dimension'=>'км/ч'],
            ['title'=>'Топливный бак','min'=>20,'max'=>1000,'dimension'=>'л.'],
        ];

        foreach($Params as $Key=>$Param){
            $Model = new \UpfModels\Params();


            /*** Content ***/
            $Model->title=$Param['title'];
            $Model->alias = \Mascame\Urlify::filter($Model->title);

            $Model->dimension=$Param['dimension'];
            /*** Settings***/
            $Model->param_type=0;
            $Model->param_min=$Param['min'];
            $Model->param_max=$Param['max'];

            /*** Relations ***/
            $Model->section='catalog';

            /*** Statuses ***/
            $Model->status = 1 ;
            $Model->save();
        }
	}
}
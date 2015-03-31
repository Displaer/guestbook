<?php
/**
 * Class for prepare DI mapping array.
 *
 * @author Dilshod Sanginov (DELL) <prodilshod@gmail.com>
 * Created 1/23/14, 1:23 AM
 * Copyright dit
 */

namespace lib;

use components\guest\GuestManager;
use components\guest\GuestLayer;
use components\accountant\AccountantLayer;
use components\accountant\AccountantManager;
use components\coefficient\CoefficientLayer;
use components\coefficient\CoefficientManager;
use components\contingent\ContingentLayer;
use components\contingent\ContingentManager;
use components\control\ControlLayer;
use components\control\ControlManager;
use components\deduction\DeductionLayer;
use components\deduction\DeductionManager;
use components\faculty\FacultyLayer;
use components\faculty\FacultyManager;
use components\finished\FinishedLayer;
use components\finished\FinishedManager;
use components\nation\NationLayer;
use components\nation\NationManager;
use components\orders\OrdersLayer;
use components\orders\OrdersManager;
use components\posts\PostsLayer;
use components\posts\PostsManager;
use components\pricelist\PricelistLayer;
use components\pricelist\PricelistManager;
use components\region\RegionLayer;
use components\region\RegionManager;
use components\reporting\ReportingLayer;
use components\reporting\ReportingManager;
use components\speciality\SpecialityLayer;
use components\speciality\SpecialityManager;
use components\transaction\TransactionLayer;
use components\transaction\TransactionManager;
use components\users\UsersLayer;
use components\users\UsersManager;


class Startup
{
    public static function init()
    {

        /* control */
        DI::mapClassAsSingleton('guest_manager', new GuestManager());
        DI::mapClassAsSingleton('guest_layer', new GuestLayer(DI::getInstanceByKey('guest_manager')));
        
        /* posts /
        DI::mapClassAsSingleton('posts_manager', new PostsManager());
        DI::mapClassAsSingleton(
            'posts_layer',
            new PostsLayer(DI::getInstanceByKey('posts_manager'), DI::getInstanceByKey('control_manager'))
        );

        /* faculty /
        DI::mapClassAsSingleton('faculty_manager', new FacultyManager());
        DI::mapClassAsSingleton('faculty_layer', new FacultyLayer(DI::getInstanceByKey('faculty_manager')));

        /* users /
        DI::mapClassAsSingleton('users_manager', new UsersManager());
        DI::mapClassAsSingleton(
            'users_layer',
            new UsersLayer(DI::getInstanceByKey('users_manager'), DI::getInstanceByKey('posts_manager'))
        );

        /* Coefficient /
        DI::mapClassAsSingleton('coefficient_manager', new CoefficientManager());
        DI::mapClassAsSingleton(
            'coefficient_layer',
            new CoefficientLayer(DI::getInstanceByKey('coefficient_manager'))
        );

       /* Region /
        DI::mapClassAsSingleton('region_manager', new RegionManager());
        DI::mapClassAsSingleton(
            'region_layer',
            new RegionLayer(DI::getInstanceByKey('region_manager'))
        );

        /* Nation /
        DI::mapClassAsSingleton('nation_manager', new NationManager());
        DI::mapClassAsSingleton(
            'nation_layer',
            new NationLayer(DI::getInstanceByKey('nation_manager'))
        );

        /* speciality /
        DI::mapClassAsSingleton('speciality_manager', new SpecialityManager());
        DI::mapClassAsSingleton(
            'speciality_layer',
            new SpecialityLayer(DI::getInstanceByKey('speciality_manager'), DI::getInstanceByKey('faculty_manager'))
        );

        /* pricelist /
        DI::mapClassAsSingleton('pricelist_manager', new PricelistManager());
        DI::mapClassAsSingleton(
            'pricelist_layer',
            new PricelistLayer(DI::getInstanceByKey('pricelist_manager'), DI::getInstanceByKey(
                'speciality_manager'
            ), DI::getInstanceByKey('faculty_manager'))
        );


        /* contingent /
        DI::mapClassAsSingleton('contingent_manager', new ContingentManager());
        DI::mapClassAsSingleton(
            'contingent_layer',
            new ContingentLayer(DI::getInstanceByKey('contingent_manager'), DI::getInstanceByKey(
                'speciality_manager'
            ), DI::getInstanceByKey('faculty_manager'))
        );


        /* deduction /
        DI::mapClassAsSingleton('deduction_manager', new DeductionManager());
        DI::mapClassAsSingleton(
            'deduction_layer',
            new DeductionLayer(DI::getInstanceByKey('deduction_manager'), DI::getInstanceByKey(
                'contingent_manager'
            ), DI::getInstanceByKey('speciality_manager'), DI::getInstanceByKey('faculty_manager'))
        );

        /* finished /
        DI::mapClassAsSingleton('finished_manager', new FinishedManager());
        DI::mapClassAsSingleton(
            'finished_layer',
            new FinishedLayer(DI::getInstanceByKey('finished_manager'), DI::getInstanceByKey(
                'contingent_manager'
            ), DI::getInstanceByKey('speciality_manager'), DI::getInstanceByKey('faculty_manager'))
        );


        /* orders /
        DI::mapClassAsSingleton('orders_manager', new OrdersManager());
        DI::mapClassAsSingleton(
            'orders_layer',
            new OrdersLayer(DI::getInstanceByKey('orders_manager'), DI::getInstanceByKey(
                'contingent_manager'
            ), DI::getInstanceByKey('speciality_manager'), DI::getInstanceByKey('faculty_manager'))
        );


        /* accountant /
        DI::mapClassAsSingleton('accountant_manager', new AccountantManager());
        DI::mapClassAsSingleton(
            'accountant_layer',
            new AccountantLayer(DI::getInstanceByKey('contingent_manager'), DI::getInstanceByKey(
                'accountant_manager'
            ), DI::getInstanceByKey('coefficient_manager'), DI::getInstanceByKey(
                'pricelist_manager'
            ), DI::getInstanceByKey('speciality_manager'), DI::getInstanceByKey('faculty_manager'))
        );


        /* Transaction /
        DI::mapClassAsSingleton('transaction_manager', new TransactionManager());
        DI::mapClassAsSingleton(
            'transaction_layer',
            new TransactionLayer(DI::getInstanceByKey('transaction_manager'), DI::getInstanceByKey(
                'contingent_manager'
            ), DI::getInstanceByKey('accountant_manager'), DI::getInstanceByKey(
                'speciality_manager'
            ), DI::getInstanceByKey('faculty_manager'))
        );

        /* reporting /
        DI::mapClassAsSingleton('reporting_manager', new ReportingManager());
        DI::mapClassAsSingleton(
            'reporting_layer',
            new ReportingLayer(DI::getInstanceByKey('reporting_manager'), DI::getInstanceByKey(
                'contingent_manager'
            ), DI::getInstanceByKey('accountant_manager'), DI::getInstanceByKey(
                'pricelist_manager'
            ), DI::getInstanceByKey('speciality_manager'), DI::getInstanceByKey('faculty_manager'))
        );
        */
    }
}


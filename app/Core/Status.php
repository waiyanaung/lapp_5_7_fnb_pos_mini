<?php namespace App\Core;

class Status
{

	// General Status
    const INACTIVE = 0;
    const ACTIVE = 1;

    const STATUS = array(
        self::INACTIVE => 'In-Active',
        self::ACTIVE => 'Active',
	);
	

    // Transaction
    const TRANSACTION_CANCEL = 0;
    const TRANSACTION_PENDING = 1;
    const TRANSACTION_CONFIRM = 2;

    const TRANSACTION = array(
        self::TRANSACTION_CANCEL => 'Cancel',
        self::TRANSACTION_PENDING => 'Pending',
        self::TRANSACTION_CONFIRM => 'Confirmed',
    );

    // Transaction_item
    const TRANSACTION_ITEM_CANCEL = 0;
    const TRANSACTION_ITEM_PENDING = 1;
    const TRANSACTION_ITEM_CONFIRM = 2;

    const TRANSACTION_ITEM = array(
        self::TRANSACTION_ITEM_CANCEL => 'Void',
        self::TRANSACTION_ITEM_PENDING => 'Pending',
        self::TRANSACTION_ITEM_CONFIRM => 'Confirmed',
    );

    // Transaction_payment
    const TRANSACTION_PAYMENT_CANCEL = 0;
    const TRANSACTION_PAYMENT_PENDING = 1;
    const TRANSACTION_PAYMENT_CONFIRM = 2;
    const TRANSACTION_PAYMENT_NOT_STARTED_YET = 3;
    const TRANSACTION_PAYMENT_IN_PROGRESS = 4;
    const TRANSACTION_PAYMENT_COMPLETED = 5;

    const TRANSACTION_PAYMENT = array(
        self::TRANSACTION_PAYMENT_CANCEL => 'Void',
        self::TRANSACTION_PAYMENT_PENDING => 'Pending',
        self::TRANSACTION_PAYMENT_CONFIRM => 'Confirmed',
        self::TRANSACTION_PAYMENT_NOT_STARTED_YET => 'Not Started Yet',
        self::TRANSACTION_PAYMENT_IN_PROGRESS => 'In Progress',
        self::TRANSACTION_PAYMENT_COMPLETED => 'Completed',
    );

    // Transaction_payment_detail
    const TRANSACTION_PAYMENT_DETAIL_CANCEL = 0;
    const TRANSACTION_PAYMENT_DETAIL_PENDING = 1;
    const TRANSACTION_PAYMENT_DETAIL_CONFIRM = 2;

    const TRANSACTION_PAYMENT_DETAIL = array(
        self::TRANSACTION_PAYMENT_DETAIL_CANCEL => 'Void',
        self::TRANSACTION_PAYMENT_DETAIL_PENDING => 'Pending',
        self::TRANSACTION_PAYMENT_DETAIL_CONFIRM => 'Confirmed',
    );
}

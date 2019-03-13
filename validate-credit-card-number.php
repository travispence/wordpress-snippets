<?php
/**
 *
 * This function will take a credit card number and check to make sure it
 * contains the right amount of digits and uses the Luhn Algorithm to
 * weed out made up numbers
 */
function validate_credit_card_number($credit_card_number)
{
    // Get the first digit
    $firstnumber = substr($credit_card_number, 0, 1);
    // Make sure it is the correct amount of digits. Account for dashes being present.
    $credit_card_number = str_replace('-', '', $credit_card_number);
    switch ($firstnumber) {
        case 3:
            if (!preg_match('/^3\d{3}[ \-]?\d{6}[ \-]?\d{5}$/', $credit_card_number)) {
                return 'This is not a valid American Express card number';
            }
            break;
        case 4:
            if (!preg_match('/^4\d{3}[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $credit_card_number)) {
                return 'This is not a valid Visa card number';
            }
            break;
        case 5:
            if (!preg_match('/^5\d{3}[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $credit_card_number)) {
                return 'This is not a valid MasterCard card number';
            }
            break;
        case 6:
            if (!preg_match('/^6011[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $credit_card_number)) {
                return 'This is not a valid Discover card number';
            }
            break;
        default:
            return 'This is not a valid credit card number';
    }
    // Here's where we use the Luhn Algorithm
    $map = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
        0, 2, 4, 6, 8, 1, 3, 5, 7, 9);
    $sum = 0;
    $last = strlen($credit_card_number) - 1;
    for ($i = 0; $i <= $last; $i++) {
        $sum += $map[$credit_card_number[$last - $i] + ($i & 1) * 10];
    }
    if ($sum % 10 != 0) {
        return 'This is not a valid credit card number';
    }
    // If we made it this far the credit card number is in a valid format
    return true;
}

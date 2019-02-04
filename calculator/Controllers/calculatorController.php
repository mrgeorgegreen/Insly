<?php


class CalculatorController
{
    private const BASE_PRICE = 11;
    private const BASE_PRICE_HIGH = 13;
    private const COMMISSION = 17;
    
    private const PRECISION = 2;

    public function calculate(calculatorRequest $params): array
    {
        //• Base price of policy is 11% from entered car value, except every Friday 15-20 o’clock (user time) when it is 13%
        $basePrice = $params->nowday = 5 && $params->nowhours > 14 && $params->nowhours < 21
            ? self::BASE_PRICE_HIGH
            : self::BASE_PRICE;

        //• Commission is added to base price (17%)
        $commissionRate = self::COMMISSION;

        //• Tax is added to base price (user entered)
        $taxRate = $params->tax;

        //• Calculate different payments separately (if number of payments are larger than 1)
        $basePremium['main'] = round($params->value / 100 * $basePrice, SELF::PRECISION);
        $commission['main'] = round($params->value / 100 * $commissionRate, SELF::PRECISION);
        $tax['main'] = round($params->value / 100 * $taxRate, SELF::PRECISION);

        //• Installment sums must match total policy sum- pay attention to cases where sum does not divide equally
        $inst = $params->instalments;
        if ($inst != 1) {
            //Separated data
            $basePremium['sep'] = round($basePremium['main'] / $inst, SELF::PRECISION);
            $commission['sep'] = round($commission['main'] / $inst, SELF::PRECISION);
            $tax['sep'] = round($tax['main'] / $inst, SELF::PRECISION);

            //Correction data for first column
            $basePremium['correction'] = round($basePremium['main'] - $basePremium['sep'] * $inst, SELF::PRECISION);
            $commission['correction'] = round($commission['main'] - $commission['sep'] * $inst, SELF::PRECISION);
            $tax['correction'] = round($tax['main'] - $tax['sep'] * $inst, SELF::PRECISION);
        }

        //• Output is rounded to two decimal places

        return [
            'value' => $params->value,
            'basePremium' => $basePremium,
            'commission' => $commission,
            'tax' => $tax,
            'instalments' => $inst
        ];
    }
}
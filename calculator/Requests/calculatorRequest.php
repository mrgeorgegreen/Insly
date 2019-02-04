<?php

Class CalculatorRequest
{
    private $params;

    public function __construct(array $params = null)
    {

        if (!$params) {
            throw new Exception('Empty params');
        }

        //• Estimated value of the car (100 - 100 000 EUR)
        if (!(isset($params['value'])
            && ($params['value'] >= 100 && $params['value'] <= 100000)
        )) {
            throw new Exception('Wrong value param');
        }

        //• Number of instalments (count of payments in which client wants to pay for the policy (1 – 12))
        if (!(isset($params['instalments'])
            && ($params['instalments'] >= 1 && $params['instalments'] <= 12)
        )) {
            throw new Exception('Wrong instalments param');
        }

        //• Tax percentage (0 - 100%)
        if (!(isset($params['tax'])
            && ($params['tax'] >= 0 && $params['tax'] <= 100)
        )) {
            throw new Exception('Wrong tax param');
        }

        if (!(isset($params['nowday'])
            && ($params['nowday'] >= 1 && $params['nowday'] <= 7)
        )) {
            throw new Exception('Wrong param');
        }

        if (!(isset($params['nowhours'])
            && ($params['nowhours'] >= 1 && $params['nowhours'] <= 24)
        )) {
            throw new Exception('Wrong tax param');
        }

        $this->params = $params;

    }

    public function getParameters(): array
    {
        return $this->params;
    }

    public function __get($name)
    {
        if (isset($this->params[$name])) {
            return $this->params[$name];
        }
        return null;
    }
}
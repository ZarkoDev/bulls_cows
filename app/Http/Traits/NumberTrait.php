<?php

namespace App\Http\Traits;

trait NumberTrait
{
    private $numbers;
    private $quantity;
    private $digitsNextToEachOther = [1, 8];
    private $digitsNotOnEvenPositions = [4, 5];

    public function generateNumber(int $quantity)
    {
        $this->quantity = $quantity;
        $this->numbers = range(1, 9);
        shuffle($this->numbers);
        $this->processRules();

        return implode('', array_slice($this->numbers, 0, $this->quantity));
    }

    private function processRules()
    {
        $this->digitsNextToEachOther();
        $this->replaceIndexesOfNumbers();
        $this->digitsNotOnEvenPositions();
    }

    private function digitsNextToEachOther()
    {
        $digits = $this->digitsNextToEachOther;
        $firstDigit = array_shift($digits);
        $secondDigit = array_shift($digits);
        $firstDigitPosition = array_search($firstDigit, $this->numbers);
        $secondDigitPosition = array_search($secondDigit, $this->numbers);

        if ( $firstDigitPosition < $this->quantity) {
            $this->moveDigitNextToPosition($secondDigit, $secondDigitPosition, $firstDigitPosition);
            return;
        }

        if ( $secondDigitPosition < $this->quantity) {
            $this->moveDigitNextToPosition($firstDigit, $firstDigitPosition, $secondDigitPosition);
            return;
        }
    }

    private function moveDigitNextToPosition(int $digit, int $digitPosition, int $nextToPosition)
    {
        // First Index
        if ($nextToPosition === 0) {
            if ($digitPosition != 1) {
                $this->numbers[1] = $digit;
                unset($this->numbers[$digitPosition]);
            }

            return;
        }

        // Last or Middle Index
        $newDigitPosition = ($nextToPosition - 1);

        if ($digitPosition != $newDigitPosition) {
            $this->numbers[$newDigitPosition] = $digit;
            unset($this->numbers[$digitPosition]);
        }
    }

    private function digitsNotOnEvenPositions()
    {
        $successfulDigits = 0;

        foreach ($this->numbers as $key=>$number) {
            if ($successfulDigits === $this->quantity) {
                break;
            }

            if (in_array($number, $this->digitsNotOnEvenPositions) && $this->isEvenPosition($key)) {
                while (true) {
                    $lastKey = array_key_last($this->numbers);
                    $lastNumber = $this->numbers[$lastKey];
                    unset($this->numbers[$lastKey]);
                    
                    if (!in_array($lastNumber, $this->digitsNotOnEvenPositions) && 
                        !in_array($lastNumber, $this->digitsNextToEachOther)
                    ) {
                        $this->numbers[$key] = $lastNumber;
                        break;
                    }
                }

                continue;
            }

            $successfulDigits++;
        }
    }

    private function replaceIndexesOfNumbers()
    {
        $this->numbers = array_values($this->numbers);
    }

    private function isEvenPosition($key)
    {
        if ($this->isFirstIndex($key)) {
            return true;
        }

        return (($key+1) % 2 == 0);
    }

    private function isFirstIndex($key)
    {
        return ($key === 0);
    }
    
    public function validateNumber($number)
    {
        $numbers = collect(str_split(($number)));

        if ($numbers->count() != $numbers->unique()->count()) {
            return false;
        }

        return true;
    }
}

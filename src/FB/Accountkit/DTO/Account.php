<?php

declare(strict_types=1);

namespace FB\Accountkit\DTO;

class Account
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $fullPhoneNumber;

    /**
     * @var string
     */
    private $countryPrefix;

    /**
     * @var string
     */
    private $nationalNumber;

    public function __construct(string $id, string $fullPhoneNumber, string $countryPrefix, string $nationalNumber)
    {
        $this->id = $id;
        $this->fullPhoneNumber = $fullPhoneNumber;
        $this->countryPrefix = $countryPrefix;
        $this->nationalNumber = $nationalNumber;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFullPhoneNumber(): string
    {
        return $this->fullPhoneNumber;
    }

    /**
     * @return string
     */
    public function getCountryPrefix(): string
    {
        return $this->countryPrefix;
    }

    /**
     * @return string
     */
    public function getNationalNumber(): string
    {
        return $this->nationalNumber;
    }
}

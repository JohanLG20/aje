<?php

namespace AJE\Utils;

abstract class UserErrorHelper
{
    public static function checkForErrors(array $values, string $action): array|bool
    {
        if ($action !== "delete") {
            $errors['lastname'] = self::checkLastnameErrors($values['lastname']);
            $errors['firstname'] = self::checkFirstnameErrors($values['firstname']);
            $errors['email'] = self::checkEmailErrors($values['email']);
            $errors['passwdconf'] = self::checkPasswordsMatch($values['passwd'], $values['passwdconf']);
            $errors['city'] = self::checkCityErrors($values['city']);
            $errors['postCode'] = self::checkPostalCodeErrors($values['postCode']);
            $errors['address'] = self::checkAddressErrors($values['address']);
            $errors['phoneNumber'] = self::checkPhoneNumberErrors($values['phoneNumber']);
            //We remove all the values that dont have any errors
            foreach ($errors as $key => $val) {
                if (is_null($val)) {
                    unset($errors[$key]);
                }
            }
            return !empty($errors) ? $errors : false;
        }
        else{
            //No infos are needed to delete a user
            return false;
        }
    }
    /**
     * @param string $lastName The last name we want to check
     * 
     * @return string|null Return a string that contains the error if one is detected, or null if there are no errors
     */
    private static function checkLastnameErrors(?string $lastName): ?string
    {
        if (strlen($lastName) > 0) {
            if (strlen($lastName) > 50) {
                return 'Veuillez entrer un nom plus court (50 caractères maximum)';
            } else {
                //Checking if there are no numbers in the name
                if ($lastName == filter_var(
                    $lastName,
                    FILTER_VALIDATE_REGEXP,
                    array('options' => array(
                        'regexp' => "/^([a-zA-Z\-]*)$/"

                    ))
                )) {
                    //No errors has been encountered so we return null
                    return null;
                } else {
                    return 'Veuillez ne pas entrer de chiffres ni de caractères spéciaux (- autorisé)';
                }
            }
        } else {
            return 'Veuillez entrer un nom';
        }
    }

    /**
     * @param string $firstName The first name we want to check
     * 
     * @return string|null Return a string that contains the error if one is detected, or null if there are no errors
     */
    private static function checkFirstnameErrors(string $firstName): ?string
    {
        if (strlen($firstName) > 0) {
            if (strlen($firstName) > 50) {
                return 'Veuillez entrer un prénom plus court (50 caractères maximum)';
            } else {
                if ($firstName == filter_var(
                    $firstName,
                    FILTER_VALIDATE_REGEXP,
                    array('options' => array(
                        'regexp' => "/^([a-zA-Z\-]*)$/"

                    ))
                )) {
                    //No errors has been encountered so we return null
                    return null;
                } else {
                    return 'Veuillez ne pas entrer de chiffres ni de caractères spéciaux (- autorisé)';
                }
            }
        } else {
            return 'Veuillez entrer un prénom';
        }
    }

    /**
     * @param string $email The email we want to check
     * 
     * @return string|null Return a string that contains the error if one is detected, or null if there are no errors
     */
    private static function checkEmailErrors(string $email): ?string
    {
        if (strlen($email) > 0) {
            if (strlen($email) <= 50) {
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    return 'Veuillez entrer un email valide (exemple@exemple.com)';
                } else {
                    //No errors has been encountered so we return null
                    return null;
                }
            } else {
                return 'Veuillez entrer une addresse plus courte (50 caractères maximum)';
            }
        } else {
            return 'Veuillez entrer un email';
        }
    }


    /**
     * @param string $passwd1 The first password entered
     * @param string $passwd2 The second password entered
     * 
     * @return string|null Return a string that contains the error if one is detected, or null if there are no errors
     */
    private static function checkPasswordsMatch(string $passwd1, string $passwd2): ?string
    {
        if (strlen($passwd1) > 0 && strlen($passwd2) > 0) {
            if ($passwd1 !== $passwd2) {
                return 'Les mots de passes ne correspondent pas';
            } else {
                return null;
            }
        } else {
            return 'Veuillez entrer un mot de passe et le confimer';
        }
    }

    private static function checkCityErrors(?string $city): ?string
    {
        if (strlen($city) > 0) {
            if (strlen($city) > 50) {
                return 'Veuillez entrer un nom de ville plus court (50 caractères maximum)';
            } else {
                if ($city == filter_var(
                    $city,
                    FILTER_VALIDATE_REGEXP,
                    array('options' => array(
                        'regexp' => "/^([a-zA-Z\-]*)$/"

                    ))
                )) {
                    //No errors has been encountered so we return null
                    return null;
                } else {
                    return 'Veuillez ne pas entrer de chiffres ni de caractères spéciaux (-  et espace autorisé)';
                }
            }
        } else {
            return 'Veuillez entrer une ville';
        }
    }


    /**
     * @param string $postCode The post code we want to check
     * 
     * @return string|null Return a string that contains the error if one is detected, or null if there are no errors
     */
    private static function checkPostalCodeErrors(string $postCode): ?string
    {
        if (strlen($postCode) > 0) {
            //Checking if there are only numbers
            if ($postCode == filter_var(
                $postCode,
                FILTER_VALIDATE_REGEXP,
                array('options' => array(
                    'regexp' => "/^([0-9]*)$/"

                ))
            )) {
                //Checking if there are only 5 numbers
                if (strlen($postCode) !== 5) {
                    return 'Veuillez entrer un code postal à 5 chiffres';
                } else {
                    //No errors has been encountered so we return null
                    return null;
                }
            } else {
                return 'Veuillez entrer uniquement des chiffres';
            }
        } else {
            return 'Veuillez entrer un code postal';
        }
    }

    /**
     * @param string $address The address we want to check
     * 
     * @return string|null Return a string that contains the error if one is detected, or null if there are no errors
     */
    private static function checkAddressErrors(string $address): ?string
    {
        if (strlen($address) > 0) {
            if (strlen($address) <= 50) {
                //Checking if the address is valid
                if ($address == filter_var(
                    $address,
                    FILTER_VALIDATE_REGEXP,
                    array('options' => array(
                        'regexp' => "/^([a-zA-Z\-\s\'0-9]*)$/"

                    ))
                )) {
                    return null;
                } else {
                    return 'Veuillez ne pas entrer de chiffres ni de caractères spéciaux (-, et espace autorisé)';
                }
            } else {
                return 'Veuillez entrer une adresse plus courte (50 caractères maximum)';
            }
        } else {
            return 'Veuillez entrer une adresse';
        }
    }

    /**
     * regex found at https://regexpattern.com/phone-number/#fr
     * @param string $phoneNumber The phone number to check
     * 
     * @return string|null Return a string that contains the error if one is detected, or null if there are no errors
     */
    private static function checkPhoneNumberErrors(string $phoneNumber): ?string
    {
        if (strlen($phoneNumber) > 0) {
            //Checking if there are only numbers
            if ($phoneNumber == filter_var(
                $phoneNumber,
                FILTER_VALIDATE_REGEXP,
                array('options' => array(
                    'regexp' => "/^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$/"

                ))
            )) {
                //No errors has been encountered so we return null
                return null;
            } else {
                return 'Veuillez entrer un numéro de téléphone valide (01.02.03.04.05)';
            }
        }
        //We return null on default because the phone number isn't requiered
        return null;
    }
}

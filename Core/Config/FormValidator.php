<?php

namespace Core\Config;

class FormValidator
{
    protected $data;
    protected $rules;
    protected $errors = [];

    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    public function validate(): bool
    {
        foreach ($this->rules as $field => $rule) {
            $rules = explode('|', $rule);
            foreach ($rules as $rule) {
                $value = $this->data[$field] ?? '';
                if ($rule === 'required' && !$this->validateRequired($value, $field)) {
                    break;
                } elseif (str_contains($rule, 'min_length') && !$this->validateMinLength($value, $field, $rule)) {
                    break;
                } elseif (str_contains($rule, 'matches') && !$this->validateMatches($value, $this->data[$this->getMatchField($field)])) {
                    break;
                } elseif ($rule === 'valid_email' && !$this->validateEmail($value, $field)) {
                    break;
                } elseif ($rule === 'valid_phone' && !$this->validatePhone($value, $field)) {
                    break;
                } elseif ($rule === 'valid_numeric' && !$this->validateNumeric($value, $field)) {
                    break;
                }
            }
        }
        return empty($this->errors);
    }

    protected function validateRequired($value, $field): bool
    {
        if (empty($value)) {
            $this->errors[$field] = ucfirst($field) . ' field is required';
            return false;
        }
        return true;
    }

    protected function validateMinLength($value, $field, $rule): bool
    {
        $length = (int) filter_var($rule, FILTER_SANITIZE_NUMBER_INT);
        if (mb_strlen($value) < $length) {
            $this->errors[$field] = ucfirst($field) . " field must be at least $length characters long";
            return false;
        }
        return true;
    }

    protected function validateMatches($value, $matchValue): bool
    {
        if ($value !== $matchValue) {
            $this->errors[] = 'Password and confirm password do not match';
            return false;
        }
        return true;
    }

    protected function validateEmail($value, $field): bool
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = 'Invalid email address';
            return false;
        }
        return true;
    }

    protected function validatePhone($value, $field): bool
    {
        if (!preg_match('/^\+?[0-9]{7,15}$/', $value)) {
            $this->errors[$field] = 'Invalid phone number';
            return false;
        }
        return true;
    }

    protected function validateNumeric($value, $field): bool
    {
        if (!is_numeric($value)) {
            $this->errors[$field] = ucfirst($field) . ' field must be numeric';
            return false;
        }
        return true;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    protected function getMatchField($field): string
    {
        return str_replace('_confirm', '', $field);
    }
}
//$rules = [
//    'username' => 'required',
//    'password' => 'required|min_length[10]',
//    'password_confirm' => 'required|matches[password]',
//    'email'    => 'required|valid_email',
//    'phone'    => 'required|valid_phone',
//    'age'      => 'required|valid_numeric',
//];
//
//$data = [
//    'username'          => 'john_doe',
//    'password'          => '1234567890',
//    'password_confirm'  => '1234567890',
//    'email'             => 'john.doe@example.com',
//    'phone'             => '+15551234567',
//    'age'               => '30',
//];
//
//$validator = new FormValidator($data, $rules);
//
//if (!$validator->validate()) {
//    $errors = $validator->getErrors();
//    // Hatalarla ilgili işlemler yapılabilir
//    print_r($errors);
//} else {
//    // Veriler başarılı bir şekilde doğrulandı
//    echo 'basarili';
//}
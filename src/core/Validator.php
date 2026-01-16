    <?php

    class Validator
    {
        private $errors = [];
        private $data = [];

        // Valide un email avec la fonction filtre de php
        public static function validateEmail($email)
        {
            return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        }

        // Valide un mot de passe (min 8 caractères)
        public static function validatePassword($password)
        {
            return strlen($password) >= 8;
        }

        /**
         * Récupère toutes les erreurs
         */
        public function errors(): array
        {
            return $this->errors;
        }
    }

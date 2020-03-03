<?php 
    include_once './role/role.php';
    
    class User {

        private $id;
        private $username;
        private $password;
        private $name;
        private $email;
        private $dateJoined;
        private $role;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getUsername() {
            return $this->username;
        }

        public function setUsername($username) {
            $this->username = $username;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setPassword($password) {
            $this->password = $password;
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
        }
        
        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getDateJoined() {
            return $this->dateJoined;
        }

        public function setDateJoined($dateJoined) {
            $this->dateJoined = $dateJoined;
        }

        public function getRole() {
            return $this->role;
        }

        public function setRole($role) {
            $this->role = $role;
        }
    }

    // sample user class
    // $user = new User();
    // $user->setUsername("sample_uname");
    // $user->setRole(new Role(1, 'role_user'));

?>
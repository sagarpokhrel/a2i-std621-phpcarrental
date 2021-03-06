<?php

    class UserDao {

        private $table = "users";

        private $db;

        public function __construct() {
            $this->db = new DB();
        }

        public function find($user) {
            $sql = "select * from " . $this->table 
                . " where username = ? and password = ?;";

            $con = $this->db->getConnection();
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ss", $p_username, $p_password);

            $p_username = $user->getUsername();
            $p_password = $user->getPassword();

            if($stmt->execute()) {
                $result = $stmt->get_result();
                if($result->num_rows > 0) {
                    if($row = $result->fetch_array()) {
                        $user = new User();
                        $user->setId($row['id']);
                        $user->setUsername($row['username']);
                        $user->setPassword($row['password']);
                        $user->setName($row['name']);
                        $user->setEmail($row['email']);
                        $user->setDateJoined($row['date_joined']);
                        $user->setRole($row['role_id']);
                        $user->setEnabled($row['is_enabled']);
                    }
                } else {
                    //echo "cannot find user [" . $user->getUsername() . "]";
                    $user = new User();
                }

                $stmt->close();
            } else {
                //echo "couldn't execute sql: " . $sql . " error: " . $con->error;
                $user = new User();
            }
            $con->close();

            return $user;
        }

        public function findByEmail($email) {

            $sql = "select * from " . $this->table 
                . " where username = ?;";

            $con = $this->db->getConnection();
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $email);

            //$p_email = $email;
            if($stmt->execute()) {
                $result = $stmt->get_result();
                if($result->num_rows > 0) {
                    if($row = $result->fetch_array()) {
                        $user = new User();
                        $user->setId($row['id']);
                        $user->setUsername($row['username']);
                        $user->setPassword($row['password']);
                        $user->setName($row['name']);
                        $user->setEmail($row['email']);
                        $user->setDateJoined($row['date_joined']);
                        $user->setRole($row['role_id']);
                    }
                } else {
                    //echo "cannot find user [" . $user->getUsername() . "]";
                    $user = new User();
                }

                $stmt->close();
            } else {
                //echo "couldn't execute sql: " . $sql . " error: " . $con->error;
                $user = new User();
            }
            $con->close();

            return $user;
        }

        public function findById($id) {

            $sql = "select * from " . $this->table 
                . " where id = ?;";

            $con = $this->db->getConnection();
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $id);

            //$p_email = $email;
            if($stmt->execute()) {
                $result = $stmt->get_result();
                if($result->num_rows > 0) {
                    if($row = $result->fetch_array()) {
                        $user = new User();
                        $user->setId($row['id']);
                        $user->setUsername($row['username']);
                        $user->setPassword($row['password']);
                        $user->setName($row['name']);
                        $user->setEmail($row['email']);
                        $user->setDateJoined($row['date_joined']);
                        $user->setRole($row['role_id']);
                    }
                } else {
                    //echo "cannot find user [" . $user->getUsername() . "]";
                    $user = new User();
                }

                $stmt->close();
            } else {
                //echo "couldn't execute sql: " . $sql . " error: " . $con->error;
                $user = new User();
            }
            $con->close();

            return $user;
        }

        public function list() {
            $sql = "select * from " . $this->table . ";";
            $list = array();

            $con = $this->db->getConnection();

            if($result = $con->query($sql)) {
                if($result->num_rows > 0) {
                    while($row = $result->fetch_array()) {
                        $user = new User();
                        $user->setId($row['id']);
                        $user->setUsername($row['username']);
                        $user->setPassword($row['password']);
                        $user->setName($row['name']);
                        $user->setEmail($row['email']);
                        $user->setDateJoined($row['date_joined']);
                        $user->setRole($row['role_id']);
                        $user->setEnabled($row['is_enabled']);
                        array_push($list, $user);
                    }
                }
            } else {
                echo "userDao: couldn't execute sql: " . $sql . " error: " . $con->error;
            }
            $con->close();

            return $list;
        }

        public function create($user) {
            

            $sql = "select * from " . $this->table 
                . " where email = ? or username = ?;";

            $con = $this->db->getConnection();
            $stmt = $con->prepare($sql);

            $email = $user->getEmail();
            $username = $user->getUsername();

            $stmt->bind_param("ss", $email, $username);
    
            //$p_email = $email;
            if($stmt->execute()) {
                $result = $stmt->get_result();
                if($result->num_rows > 0) {
                    return "already";
                }
            }


            $flag = false;

            $sql = "insert into " . $this->table . " (username, password, name, email, date_joined, role_id)"
                    . " values (?, ?, ?, ?, date_format(now(), '%Y-%m-%d'), ?)";

            $con = $this->db->getConnection();
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssssi",
                $p_username,
                $p_password,
                $p_name,
                $p_email,
                $p_role
            );

            $p_username = $user->getUsername();
            $p_password = $user->getPassword();
            $p_name = $user->getName();
            $p_email = $user->getEmail();
            $p_role = $user->getRole();

            if($stmt->execute()) {
                $flag = true;
            }

            $stmt->close();
            $con->close();
            return $flag;
        }

        public function update($user) {
            $flag = false;

            $sql = "update " . $this->table
                . " set username = ?, name = ?, email = ? where id = ?;";

            $con = $this->db->getConnection();
            $stmt = $con->prepare($sql);

            $p_username = $user->getUsername();
            $p_name = $user->getName();
            $p_email = $user->getEmail();
            $p_id = $user->getId();


            $stmt->bind_param("sssi",
                $p_username,
                $p_name,
                $p_email,
                $p_id
            );

            if($stmt->execute()) {
                $flag = true;
            }

            $stmt->close();
            $con->close();
            return $flag;
        }

        public function delete($user) {
            $flag = false;

            $sql = "delete from " . $this->table
                . " where id = ?;";
            
            $con = $this->db->getConnection();
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $p_id);

            $p_id = $user->getId();
            
            if($stmt->execute()) {
                $flag = true;
            }

            $stmt->close();
            $con->close();
            return $flag;
        }
    }

?>
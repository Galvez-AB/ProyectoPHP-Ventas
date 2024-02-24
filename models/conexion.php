<?php
    class ConnectionBD {
        private $con = null;

            public function connect() {
                $this->con = mysqli_connect('127.0.0.1', 'root', '', 'burgerfisi');
                if (mysqli_connect_errno()) {
                    die("Error de conexión: " . mysqli_connect_error());
                }
                return $this->con;
            }

            public function disconnect() {
                if ($this->con != null) {
                    mysqli_close($this->con);
                    $this->con = null;
                }
                return $this->con;
            }
    }
?>

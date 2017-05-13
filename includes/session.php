<?php

class CryptoToolsSession {
    public $user_id;
    public $session_id;

    /** @var CryptoTools */
    protected $cryptotools;

    public function __construct($cryptotools, $user_id, $session_id) {
        $this->cryptotools = $cryptotools;
        $this->user_id = $user_id;
        $this->session_id = $session_id;
        $this->purgeSessions();
    }

    private function purgeSessions() {
        $sql_purge_sessions = $this->cryptotools->db->prepare("DELETE FROM sessions WHERE expires<=NOW()");
        $sql_purge_sessions->execute();
    }

    public function check($update = true) {
        $sql_check_session = $this->cryptotools->db->prepare("SELECT s.id FROM sessions s WHERE s.user_id=:user_id AND s.session_id=:session_id AND s.expires>NOW()");
        $sql_check_session->bindValue(':user_id', $this->user_id, PDO::PARAM_STR);
        $sql_check_session->bindValue(':session_id', $this->session_id, PDO::PARAM_STR);
        $sql_check_session->execute();

        if ($row = $sql_check_session->fetch(PDO::FETCH_ASSOC)) {
            if ($update) {
                $this->update();
            }
            return true;
        }
        return false;
    }

    public function update() {
        $sql_update_session = $this->cryptotools->db->prepare("INSERT INTO sessions (id, created, user_id, session_id, ip_address, expires) VALUES (:id, NOW(), :user_id, :session_id, :ip_address, NOW() + INTERVAL :seconds SECOND) ON DUPLICATE KEY UPDATE user_id=:user_id, ip_address=:ip_address, expires=NOW() + INTERVAL :seconds SECOND");
        $sql_update_session->bindValue(':id', $this->cryptotools->generateUUID(), PDO::PARAM_STR);
        $sql_update_session->bindValue(':user_id', $this->user_id, PDO::PARAM_STR);
        $sql_update_session->bindValue(':session_id', $this->session_id, PDO::PARAM_STR);
        $sql_update_session->bindValue(':ip_address', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
        $sql_update_session->bindValue(':seconds', $this->cryptotools->config['session_time'], PDO::PARAM_INT);
        $sql_update_session->execute();
    }

    public function delete() {
        $sql_delete_session = $this->cryptotools->db->prepare("DELETE FROM sessions s WHERE s.user_id=:user_id AND s.session_id=:session_id");
        $sql_delete_session->bindValue(':user_id', $this->user_id, PDO::PARAM_STR);
        $sql_delete_session->bindValue(':session_id', $this->session_id, PDO::PARAM_STR);
        $sql_delete_session->execute();
    }
}

class CryptoToolsCurrentSession extends CryptoToolsSession {
    public function __construct($cryptotools, $user_id) {
        parent::__construct($cryptotools, $user_id, session_id());
    }
}

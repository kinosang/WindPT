<?php

defined('WEKIT_VERSION') || exit('Forbidden');

class PwTorrentPeerDao extends PwBaseDao
{
    protected $_table      = 'app_torrent_peer';
    protected $_pk         = 'id';
    protected $_dataStruct = array('id', 'torrent', 'peer_id', 'uid', 'ip', 'port', 'uploaded', 'downloaded', 'left', 'seeder', 'started', 'last_action', 'connectable', 'agent', 'finished_at', 'passkey');

    public function getTorrentPeer($id)
    {
        return $this->_get($id);
    }

    public function getTorrentPeerByPeerID($peer_id)
    {
        $sql = $this->_bindTable('SELECT * FROM %s WHERE peer_id = ?');
        $smt = $this->getConnection()->createStatement($sql);
        return $smt->getOne(array($peer_id));
    }

    public function getTorrentPeerByPeerIDAndTorrentID($peer_id, $torrent_id)
    {
        $sql = $this->_bindTable('SELECT * FROM %s WHERE peer_id = ? AND torrent = ?');
        $smt = $this->getConnection()->createStatement($sql);
        return $smt->getOne(array($peer_id, $torrent_id));
    }

    public function getTorrentPeerByTorrent($tid)
    {
        $sql = $this->_bindSql('SELECT * FROM %s WHERE torrent = ?', $this->getTable());
        $smt = $this->getConnection()->createStatement($sql);
        return $smt->queryAll(array($tid), 'id');
    }

    public function getTorrentPeerByTorrentAndUid($tid, $uid)
    {
        $sql = $this->_bindSql('SELECT * FROM %s WHERE torrent = ? AND uid = ?', $this->getTable());
        $smt = $this->getConnection()->createStatement($sql);
        return $smt->getOne(array($tid, $uid), 'id');
    }

    public function fetchTorrentPeerByUid($uid)
    {
        $sql = $this->_bindTable('SELECT * FROM %s WHERE uid = ?');
        $smt = $this->getConnection()->createStatement($sql);
        return $smt->queryAll(array($uid));
    }

    public function addTorrentPeer($fields)
    {
        return $this->_add($fields);
    }

    public function updateTorrentPeer($id, $fields, $increaseFields = array())
    {
        return $this->_update($id, $fields);
    }

    public function deleteTorrentPeer($id)
    {
        return $this->_delete($id);
    }
}

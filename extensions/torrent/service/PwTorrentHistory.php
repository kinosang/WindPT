<?php

defined('WEKIT_VERSION') || exit('Forbidden');

class PwTorrentHistory
{
    const FETCH_MAIN = 1;

    public function getTorrentHistory($id, $fetchmode = self::FETCH_MAIN)
    {
        if (empty($id)) {
            return array();
        }

        return $this->_getDao($fetchmode)->getTorrentHistory($id);
    }

    public function getTorrentHistoryByTorrentIdAndUid($torrent, $uid, $fetchmode = self::FETCH_MAIN)
    {
        return $this->_getDao($fetchmode)->getTorrentHistoryByTorrentIdAndUid($torrent, $uid);
    }

    public function fetchTorrentHistoryByTorrentId($torrent, $fetchmode = self::FETCH_MAIN)
    {
        return $this->_getDao($fetchmode)->fetchTorrentHistoryByTorrentId($torrent);
    }

    public function fetchTorrentHistoryByUid($uid, $fetchmode = self::FETCH_MAIN)
    {
        return $this->_getDao($fetchmode)->fetchTorrentHistoryByUid($uid);
    }

    public function addTorrentHistory(PwTorrentHistoryDm $dm)
    {
        if (($result = $dm->beforeAdd()) !== true) {
            return $result;
        }
        return $this->_getDao(self::FETCH_MAIN)->addTorrentHistory($dm->getData());
    }

    public function updateTorrentHistory(PwTorrentHistoryDm $dm, $fetchmode = self::FETCH_MAIN)
    {
        if (($result = $dm->beforeUpdate()) !== true) {
            return $result;
        }
        return $this->_getDao($fetchmode)->updateTorrentHistory($dm->id, $dm->getData(), $dm->getIncreaseData());
    }

    public function deleteTorrentHistory($id)
    {
        if (empty($id)) {
            return false;
        }

        return $this->_getDao(self::FETCH_MAIN)->deleteTorrentHistory($id);
    }

    protected function _getDaoMap()
    {
        return array(self::FETCH_MAIN => 'EXT:torrent.service.dao.PwTorrentHistoryDao');
    }

    protected function _getDao($fetchmode = self::FETCH_MAIN)
    {
        return Wekit::loadDaoFromMap($fetchmode, $this->_getDaoMap(), 'PwTorrentHistoryDao');
    }
}

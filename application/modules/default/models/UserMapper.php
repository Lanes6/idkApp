<?php
class UserMapper extends Model{
    public function getUsers(){
        return $this->getAll('users','User');
    }
}
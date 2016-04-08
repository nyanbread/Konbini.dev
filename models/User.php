<?php

require_once __DIR__ . '/BaseModel.php';
/* Dude, like 90% of this is copy pasted from Ad.php.
/* You really need to check the tables next time. */
class User extends Model
{
    private $options = [
            'cost' => 12,
        ];
    protected function insert($dbc)
    {
        $insert = 'INSERT INTO users (user, password, e_mail, location, userlevel)
                    VALUES (:user, :password, :e_mail, :location, :userlevel)';
        $stmt = $dbc->prepare($insert);
        foreach ($this->attributes as $key => $value){
            echo $value;
            if ($key == "password")
            {
                $stmt->bindValue(":".$key, password_hash($value, PASSWORD_BCRYPT, $this->options), PDO::PARAM_STR);
            }
            else
            {
                $stmt->bindValue(":".$key, $value, PDO::PARAM_STR);
            }
        }
        $stmt->execute();
    }

    protected function update($dbc)
    {
        $update = 
        'UPDATE users 
        SET user = :user, 
            item = :item, 
            description = :description, 
            price = :price, 
            img_url = :img_url 
        WHERE id = :id';
        $stmt = self::$dbc->prepare($update);

        foreach ($this->attributes as $key => $value) {
            $stmt->bindValue(":$key", "$value", PDO::PARAM_STR);
        }
        $stmt->execute();
    }

    /**
     * Find a single record in the DB based on its id
     *
     * @param int $id id of the user entry in the database
     *
     * @return User An instance of the User class with attributes array set to values from the database
     */
    public static function findname($name, $dbc)
    {
        $select = 'SELECT * FROM users WHERE user = :user';
        $stmt = $dbc->prepare($select);
        $stmt->bindValue(':user', $name, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch();

        return $result;
    }
}

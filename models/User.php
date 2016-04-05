<?php

require_once __DIR__ . '/BaseModel.php';

class User extends Model
{
    protected static $table = 'ads';

    protected $columns = 
    [
        'id',
        'user',
        'item',
        'description',
        'price',
        'img_url',
    ];

    protected function insert($dbc)
    {
        $insert = 'INSERT INTO ads (user, item, description, price, img_url)
                    VALUES (:user, :item, :description, :price, :img_url)';
        $stmt = self::$dbc->prepare($insert);
        unset($this->attributes['id']);
        foreach ($this->attributes as $key => $value){
            $stmt->bindValue(":$key", $value, PDO::PARAM_STR);
        }
        $stmt->execute();
        $this->attributes['id'] = self::$dbc->lastInsertId();
        
        
    }

    protected function update($dbc)
    {
        $update = 
        'UPDATE ads 
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

    /**
     * Find all records in a table
     *
     * @return User[] Array of instances of the User class with attributes set to values from database
     */
    public static function all()
    {
        self::dbConnect();

        // @TODO: Learning from the find method, return all the matching records
        $select = 'SELECT * FROM user';
        $stmt = self::$dbc->prepare($select);
        $stmt->execute();

        $result = $statement->fetchAll();
        $user = [];
        foreach ($result as $row) {
            $user[] = new User($row);
        }
        return $user;
    }
}

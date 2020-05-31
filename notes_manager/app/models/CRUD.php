<?php

class CRUD {
    
    private $db;
    
    public function __construct() {
        require_once '../app/core/Database.php';
        $this->db = new Database();
    }
    
    public function create() {
        if(isset($_POST['add_note_btn'])) {
            $_POST = filter_input_array(INPUT_POST ,$_POST);

            $data = [
                'note_title' => isset($_POST['note_title']) ?  trim($_POST['note_title']) : '',
                'note_content' => isset($_POST['note_content']) ? trim($_POST['note_content']) : '',
                'note_title_err' => '',
                'note_content_err' => ''
            ];

            if(empty($data['note_title']))
                $data['note_title_err'] = 'Please type title of the note';
            if(empty($data['note_content']))
                $data['note_content_err'] = 'Please type in your note';
            
            if(!empty($data['note_title_err']) || !empty($data['note_content_err']) )
                return $data;
            else {
                $sql = "
                INSERT INTO notes(id, title, note, user_id) 
                VALUES ('',:note_title, :note_content, :userid)
                ";
                $pdo = $this->db->connect()->prepare($sql);
                $pdo->bindParam(':note_title', $data['note_title'] );
                $pdo->bindParam(':note_content', $data['note_content'] );
                $pdo->bindParam(':userid', $_SESSION['userid'] );
                $pdo->execute();
            }
        }
            
    }
    public function read() { // set as default method
        
        $sql = "SELECT notes.title, notes.note, notes.id 
                FROM notes, users
                WHERE notes.user_id = users.id AND users.id = :userid;";
        
        $pdo = $this->db->connect()->prepare($sql);
        $pdo->bindParam(":userid", $_SESSION['userid']);
        $pdo->execute();
        $notes = $pdo->fetchAll();
        
        $data['table_of_notes'] = "
            <table class=''>
            <thead>
              <tr>
                <th class=''>Title</th>
                <th class=''>Note</th>
                <th class=''>Update</th>
                <th class=''>Delete</th>
              </tr>
            </thead>
            <tbody>";
        foreach($notes as $note) {
            
            $data['table_of_notes'] = $data['table_of_notes'] . "
              <tr>
                <td class=''>" . $note['title'] . "</td>
                <td class=''>" . $note['note'] . "</td>
                <td class=''><a href='" . URLROOT ."/Pages/home/update/" . $note['id'] . "'>Update</a></td>
                <td class=''><a href='" . URLROOT ."/Pages/home/delete/" . $note['id'] . "'>Delete</a></td>
              </tr>
            ";
            
        }
        $data['table_of_notes'] = $data['table_of_notes'] . "
                        </tbody>
                        </table>";
        return $data;
    }
    public function update( $param ) {
        $sql = "SELECT notes.title, notes.note
            FROM notes, users
            WHERE users.id = :userid AND notes.id = :noteid";
        $pdo = $this->db->connect()->prepare($sql);
        $pdo->bindParam(":userid", $_SESSION['userid']);   
        $pdo->bindParam(":noteid", $param);
        $pdo->execute();
        $rows = $pdo->rowCount();
        if($rows == 0)
            header("location:" . URLROOT . "/Pages/home/read");
        else {
            $note = $pdo->fetch();
            $data = [
                'note_title' => $note['title'],
                'note_content' => $note['note']
            ];

            if(!isset($_POST['update_note_btn']))
                return $data;
            else {
                $_POST = filter_input_array(INPUT_POST ,$_POST);

                $data = [
                    'note_title' => isset($_POST['note_title']) ?  trim($_POST['note_title']) : '',
                    'note_content' => isset($_POST['note_content']) ? trim($_POST['note_content']) : '',
                    'note_title_err' => '',
                    'note_content_err' => ''
                ];

                if(empty($data['note_title']))
                    $data['note_title_err'] = 'Please type title of the note';
                if(empty($data['note_content']))
                    $data['note_content_err'] = 'Please type in your note';

                if(!empty($data['note_title_err']) || !empty($data['note_content_err']) )
                    return $data;
                else {
                    $sql = "
                        UPDATE notes 
                        SET title = :title ,note = :note
                        WHERE id = :param AND user_id = :userid;
                    ";
                    $pdo = $this->db->connect()->prepare($sql);
                    $pdo->bindParam(":title", $data['note_title']);   
                    $pdo->bindParam(":note", $data['note_content']);   
                    $pdo->bindParam(":userid", $_SESSION['userid']);   
                    $pdo->bindParam(":param", $param);
                    $pdo->execute();
                    header("location:" . URLROOT . "/Pages/home/read");
                }
            }
        }
        
    }
    public function delete( $param ) {
        $sql = "SELECT notes.title, notes.note
            FROM notes, users
            WHERE users.id = :userid AND notes.id = :noteid";
        $pdo = $this->db->connect()->prepare($sql);
        $pdo->bindParam(":userid", $_SESSION['userid']);   
        $pdo->bindParam(":noteid", $param);
        $pdo->execute();
        $rows = $pdo->rowCount();
        if($rows == 0)
            header("location:" . URLROOT . "/Pages/home/read");
        else {
            $note = $pdo->fetch();
            $data = [
                'note_title' => $note['title'],
                'note_content' => $note['note']
            ];
            
            if(!isset($_POST['delete_note_btn']))
                return $data;
            else {
                $sql = "
                    DELETE FROM notes WHERE notes.id = :noteid;
                ";
                $pdo = $this->db->connect()->prepare($sql);
                $pdo->bindParam(":noteid", $param);   
                $pdo->execute();
                header("location:" . URLROOT . "/Pages/home/read");
            }
        }
    
    }
}

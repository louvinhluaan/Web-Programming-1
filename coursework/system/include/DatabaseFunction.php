<?php
    // -------------------Query SQL------------------- //
    function query($pdo, $sql, $parameters = []) {
        $query = $pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    // -------------------Questions------------------- //
    function totalQuestions($pdo) {
        $query = query($pdo, 'SELECT COUNT(*) FROM question');
        $row = $query->fetch();
        return $row[0];
    }

    function allQuestions($pdo) {
        $questions = query($pdo, 'SELECT q.id, q.quest_title, q.questtext, q.questdate, q.images, q.userid, q.moduleid, u.name AS user_name, u.email, m.name as module_name
                                            FROM question q
                                            INNER JOIN user u ON q.userid = u.id
                                            INNER JOIN module m ON q.moduleid = m.id
                                            ORDER BY q.questdate DESC, q.id DESC');
        return $questions->fetchAll();
    }

    function getQuestionById($pdo, $id) {
        $parameters = [':id' => $id];
        $query = query($pdo, 
                       'SELECT q.id, q.quest_title, q.questtext, q.questdate, q.images, q.userid, q.moduleid, u.name AS user_name, m.name AS module_name
                                FROM question q
                                JOIN user u ON q.userid = u.id
                                JOIN module m ON q.moduleid = m.id
                                WHERE q.id = :id',
                $parameters);
        return $query->fetch();
    }

    function getQuestionsAskedByUser($pdo, $user_id) {
        $parameters = [':user_id' => $user_id];
        $query = query($pdo, "SELECT COUNT(*) FROM question WHERE userid = :user_id", $parameters);
        return $query->fetchColumn();
    }

    function getQuestionsInModule($pdo, $module_id) {
        $parameters = [':module_id'=> $module_id];
        $sql = "SELECT q.id, q.quest_title, q.questtext, q.questdate, u.name AS user_name
                FROM question q
                JOIN user u ON q.userid = u.id
                WHERE q.moduleid = :module_id
                ORDER BY q.questdate DESC";
        $query = query($pdo, $sql, $parameters);
        return $query->fetchAll();
    }

    function getRecentQuestions($pdo, $user_id) {
        $parameters = [':user_id' => $user_id];
        $sql = "SELECT id, quest_title, questtext, questdate FROM question WHERE userid = :user_id ORDER BY questdate DESC LIMIT 5";
        $query = query($pdo, $sql, $parameters);
        return $query->fetchAll();  
    }    

    function addQuestion($pdo, $quest_title, $questtext, $images, $userid, $moduleid) {
        $query = 'INSERT INTO question (quest_title, questtext, questdate, images, userid, moduleid)
                  VALUES (:quest_title, :questtext, NOW(), :images, :userid, :moduleid)';
        $parameters = ['quest_title' => $quest_title, ':questtext' => $questtext, ':images' => $images, ':userid' => $userid, ':moduleid' => $moduleid];
        query($pdo, $query, $parameters);
    }
    
    function deleteQuestion($pdo, $id){
        $parameters = [':id' => $id];
        query($pdo, 'DELETE FROM question WHERE id = :id', $parameters);
    }

    function editQuestion($pdo, $questid, $quest_title, $questtext, $images, $moduleid){
        $query = 'UPDATE question 
                  SET quest_title = :quest_title, 
                  questtext = :questtext,
                  images = :images,
                  moduleid = :moduleid
                  WHERE id = :id';
        $parameters = [':id' => $questid, ':quest_title' => $quest_title, ':questtext' => $questtext, ':images' => $images, ':moduleid' => $moduleid];
        query($pdo, $query, $parameters);
    }

    // -------------------Answers------------------- //
    function getAnswersByQuestionId($pdo, $questionId) {
        $parameters = [':q_id' => $questionId];
        $sql = "SELECT * FROM answers WHERE question_id = :q_id ORDER BY created_at DESC";
        $stmt = query($pdo, $sql, $parameters);
        return $stmt->fetchAll();
    }
    
    function getRecentAnswers($pdo, $user_id) {
        $parameters = ['user_id' => $user_id];
        $sql = "SELECT answers.id, answers.answer_text, answers.created_at, question.quest_title, question_id
                FROM answers
                JOIN question ON answers.question_id = question.id
                WHERE answers.user_id = :user_id
                ORDER BY answers.created_at DESC
                LIMIT 5";
        $query = query($pdo, $sql, $parameters);
        return $query->fetchAll();
    }

    function addAnswer($pdo, $user_id, $question_id, $answer_text, $user_name) {
        $sql = "INSERT INTO answers (user_id, question_id, answer_text, user_name, created_at) 
                VALUES (:user_id, :question_id, :answer_text, :user_name, NOW())";
        $parameters = [':user_id' => $user_id, 
                    ':question_id' =>$question_id, 
                    ':answer_text' => $answer_text,
                    ':user_name' => $user_name];
        query($pdo, $sql, $parameters);
    }

    function deleteAnswer($pdo, $id) {
        $parameters = [':id' => $id];
        $sql = "DELETE FROM answers WHERE id = :id";
        query($pdo, $sql, $parameters);
    }     
    
    // -------------------Users------------------- //
    function totalUsers($pdo) {
        $totalUsers = query($pdo, 'SELECT COUNT(*) FROM user');
        $row = $totalUsers->fetch();
        return $row[0];
    }

    function getAllUsers($pdo) {
        $query = "SELECT u.id, u.name, u.email, u.created_at, u.bio
                FROM user u
                ORDER BY u.created_at DESC";
        $allUsers = query($pdo, $query);
        return $allUsers->fetchAll();
    }

    function getUserById($pdo, $id) {
        $parameters = [':id' => $id];
        $query = query($pdo, "SELECT * FROM user WHERE id = :id", $parameters); 
        return $query->fetch();
    }

    function addUser($pdo, $name, $email, $password) {
        $parameters = [':name' => $name, ':email' => $email, ':password' => $password];
        $sql = 'INSERT INTO user SET
                `name` = :name,
                email = :email,
                `password` = :password';
        query($pdo, $sql, $parameters);
    }

    function addUserRole($pdo, $user_id) {
        $parameters = [':user_id' => $user_id];
        query($pdo, 'INSERT INTO userrole SET userid = :user_id, roleid = 2', $parameters);
    }

    function deleteUser($pdo, $id) {
        $parameters = [':id' => $id];
        query($pdo, "DELETE FROM user WHERE id = :id", $parameters); 
    }

    function editUser($pdo, $id, $name, $email) {
        $query = "UPDATE user SET name = :name, email = :email WHERE id = :id";
        $parameters = [':id' => $id, ':name' => $name, ':email' => $email];
        query($pdo, $query, $parameters);
    }
    
    function editProfile($pdo, $name, $bio, $user_id) {
        $parameters = [':name' => $name, ':bio' => $bio, ':user_id' => $user_id];
        query($pdo, "UPDATE user SET name = :name, bio = :bio WHERE id = :user_id", $parameters);
    }

    // -------------------Modules------------------- //
    function totalModules($pdo) {
        $modules = query($pdo, 'SELECT * FROM module');
        return $modules->fetchAll();
    }

    function getAllModules($pdo) {
        $query = "SELECT m.id, m.name, m.description, m.created_at, COUNT(q.id) AS question_count
                    FROM module m
                    LEFT JOIN question q ON m.id = q.moduleid
                    GROUP BY m.id
                    ORDER BY question_count DESC, m.created_at DESC";
        $allModules = query($pdo, $query);
        return $allModules->fetchAll();
    }

    function getModuleById($pdo, $id) {
        $parameters = [':id' => $id];
        $query = query($pdo, "SELECT * FROM module WHERE id = :id", $parameters);
        return $query->fetch();
    }

    function addModule($pdo, $name, $description) {
        $query = "INSERT INTO module (name, description) VALUES (:name, :description)";
        $parameters = [':name' => $name, ':description' => $description];
        query($pdo, $query, $parameters);
    }

    function editModule($pdo, $id, $name) {
        $query = "UPDATE module SET name = :name WHERE id = :id";
        $parameters = [':id' => $id, ':name' => $name];
        query($pdo, $query, $parameters);
    }

    function deleteModule($pdo, $id) {
        $parameters = [':id' => $id];
        query($pdo, "DELETE FROM module WHERE id = :id", $parameters);
    }

    // ---------Contact Messages--------- //
    function getAllContactMessages($pdo) {
        $query = query($pdo, "SELECT * FROM contact_messages ORDER BY created_at DESC");
        return $query->fetchAll();
    }

    function addContactMessages($pdo, $name, $email, $message) {
        $sql = "INSERT INTO contact_messages (name, email, message) 
                VALUES (:name, :email, :message)";
        $parameters = [':name' => $name, ':email' => $email, ':message' => $message];
        query($pdo, $sql, $parameters);
    }
    
    function deleteContactMessages($pdo, $id) {
        $parameters = [':id' => $id];
        query($pdo, "DELETE FROM contact_messages WHERE id = :id", $parameters);
    }

    // -------------------System------------------- //
    // ---------Pagination--------- //
    function getAllQuestionsPaginated($pdo, $limit, $offset) {
        $sql = "SELECT q.*, u.name AS user_name, email, m.name AS module_name
                FROM question q
                LEFT JOIN user u ON q.userid = u.id
                LEFT JOIN module m ON q.moduleid = m.id
                ORDER BY q.questdate DESC, q.id DESC
                LIMIT $limit OFFSET $offset";
        $query = query($pdo, $sql);
        return $query->fetchAll();
    }

    // ---------Searching--------- //
    function searchQuestions($pdo, $keyword) {
        $sql = "SELECT q.*, u.name AS user_name, email, m.name AS module_name
                FROM question q
                LEFT JOIN user u ON q.userid = u.id
                LEFT JOIN module m ON q.moduleid = m.id
                WHERE q.questtext LIKE :kw
                ORDER BY q.questdate DESC";
        $parameters = [':kw' => '%' . $keyword . '%'];
        $query = query($pdo, $sql, $parameters);
        return $query->fetchAll();
    }

    function countSearchResults($pdo, $keyword) {
        $parameters = [':kw' => '%' . $keyword . '%'];
        $query = query($pdo, "SELECT COUNT(*) FROM question WHERE questtext LIKE :kw", $parameters);
        return $query->fetchColumn();
    }
    
    function searchQuestionsPaginated($pdo, $keyword, $limit, $offset) {
        $sql = "SELECT q.*, u.name AS user_name, email, m.name AS module_name
                FROM question q
                LEFT JOIN user u ON q.userid = u.id
                LEFT JOIN module m ON q.moduleid = m.id
                WHERE q.questtext LIKE :kw
                ORDER BY q.questdate DESC
                LIMIT $limit OFFSET $offset";
        $parameters = [':kw' => '%' . $keyword . '%'];
        $query = query($pdo, $sql, $parameters);
        return $query->fetchAll();
    }     

    // ---------Table Exists--------- //
    function tableExists($pdo, $tableName) {
        try {
            $result = query($pdo, "SHOW TABLES LIKE '$tableName'");
            return $result->rowCount() > 0;
        } catch (Exception $e) {
            return false;
        }
    }

    // ---------Sign Up--------- //
    function checkTakenUsername ($pdo, $name) {
        $parameters = [':name' => $name];
        $query = query($pdo, "SELECT id FROM user WHERE name = :name LIMIT 1", $parameters);
        return $query->fetch();
    }
    
    function checkTakenEmail ($pdo, $email) {
        $parameters = [':email' => $email];
        $query = query($pdo, "SELECT id FROM user WHERE email = :email LIMIT 1", $parameters);
        return $query->fetch();
    }

    // ---------Login--------- //
    function checkEmail($pdo, $email) {
        $parameters = [':email' => $email];
        $query = query($pdo, "SELECT * FROM user WHERE email = :email", $parameters);
        return $query->fetch();
    }

    function getUserRoles($pdo, $user_id) {
        $parameters = [':user_id' => $user_id];
        $sql = "SELECT role.name FROM role 
            JOIN userrole ON role.id = userrole.roleid 
            WHERE userrole.userid = :user_id";
        $query = query($pdo, $sql, $parameters);
        return $query->fetch();
    }
    
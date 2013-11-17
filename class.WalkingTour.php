<?php
/**
*@Author: Ahmed Shams
*@Description: This class handles walking tour object CRUD operations as well as validating fields.
**/
class WalkingTour extends BaseObject{
    
    public $Name;
    public $tourid;
    public $oldTourid;
    public $collegeid;
    public $sortOrder;
    public $isDefault;
    public $trails;
    public $trailIDs;
    
    const toursTable = 'tours';
    const trailsTable = 'trails';
    const tourTrailsTable = 'tour_trails';
    
    function __construct($fields = array()) {
    	if (!empty($fields)) {
    		$this->setFields($fields);
    	}        
    }
    
    /**
    * Create tour record 
    * @return boolean|integer last inserted tourid
    */
    public function create() {
    	$mysqli = self::getMysqliInstance();
    	$sql = "INSERT INTO ".self::toursTable." (`tourid`, `collegeid`, `Name`, `sort_order`)
        VALUES(?, ?, ?, ?);";

	    if ($stmt = $mysqli->prepare($sql)) {
	        $stmt->bind_param('sssi', $this->tourid, $this->collegeid, $this->Name, $this->sortOrder);
	        $stmt->execute();
	        if ($stmt->affected_rows == -1) {
	            return false;
	        }
	        
	        $stmt->close();
	    } else {	        
	        return false;
	    }
	    
    	if (!empty($this->trailIDs)) {
    		$this->assignTrails($this->trailIDs);    		
    	}
	
	    return true;
    }
    
    /**
    * Update tour and tour_trail record and Inserts a record with tourid
    * @param String $tourid
    * @param String $collegeid
    * @return boolean
    */
    public function update() {
    	$mysqli = self::getMysqliInstance();
    	$sql = "UPDATE ".self::toursTable." SET 
    				`collegeid` = ?,
    				`Name` = ?,
    				`sort_order`= ?
    			WHERE `tourid` = ? AND `collegeid` = ?";
		$this->oldTourid =  (empty($this->oldTourid)) ? $this->tourid : $this->oldTourid;
		
    	if ($stmt = $mysqli->prepare($sql)) {
    		$stmt->bind_param('ssiss', $this->collegeid, $this->Name, $this->sortOrder, $this->tourid, $this->collegeid);
    		$stmt->execute();
    		if ($stmt->affected_rows == -1) {
    			echo $mysqli->error;    			
    		} else if ($stmt->affected_rows == 0 and empty($this->trailIDs)) {
    			return -1;    			
    		}
    		
    		$stmt->close();
    	} else {
    		echo 'Unable to prepare statement: ' . $mysqli->error;
    		return false;
    	}
    	if (!empty($this->trailIDs)) {
    		$this->assignTrails($this->trailIDs);    		
    	}
    	return true;
    }
    
    /**
    * Validates the required fields. Adds to the $errors array if there is an error with
    * one of the fields.
    *
    * @return array array of errors (if any)
    */
    public function validate() {
    	$errors = array();
    	if (!is_numeric($this->sortOrder)) {
    		$errors['sort_order'] = 'Sort Order must be a number.';
    	}
    	else if ($this->sortOrder < 1) {
    		$errors['sort_order'] = 'Sort Order cannot be less than one.';
    	}
    	return $errors;
    }
    
    /**
    * Gets an array of WalkingTour objects from the table
    * based on $collegid
    *
    * @static
    * @param string $collegeid college id of interest
    * @return array array of WalkingTour objects
    */
    public static function getAllToursByCollege($collegeid) {
    	$mysqli = self::getMysqliInstance();
    	$query = "SELECT *
                FROM " . self::toursTable . "
                WHERE collegeid = '$collegeid'";
    	$query .= " ORDER BY sort_order ASC";
    	$result = $mysqli->query($query);
    	$data = array();
    	if ($result) {
    		while($row = $result->fetch_assoc()){
    			$data[] = new WalkingTour($row);
    		}
    		$result->free();
    	}
    	$mysqli->close();
    	return $data;
    }
    
    /**
    * Gets a WalkingTour object from the table
    * based on $tourid and $collegeid
    *
    * @static
    * @param string $tourid tour id of interest
    * @param string $collegeid
    * @return array object of WalkingTour
    */
    public static function getTourByIdAndCollege($tourid, $collegeid) {
    	$tour = array();
    	$mysqli = self::getMysqliInstance();
    	$query = "SELECT *
                        FROM " . self::toursTable . " t                        
                        WHERE t.tourid = '$tourid' AND t.collegeid = '$collegeid'";
    	$result = $mysqli->query($query);
    	$data = array();
    	if ($result->num_rows > 0) {
    		$row = $result->fetch_assoc();
    		$result->free();    		
    		$tour = new WalkingTour($row);    		
    	} 
    	$mysqli->close();
    	return $tour;
    }
    
    /**
    * Gets an array of WalkingTour objects from the table
    * based on $tourid and $collegeis
    *
    * @static
    * @param string $tourid tour id of interest
    * @param string $collegeid
    * @return array array of WalkingTour objects
    */
    public static function getTrailsByTourAndCollege($tourid, $collegeid) {
    	$mysqli = self::getMysqliInstance();
    	$query = "SELECT *
                    FROM " . self::tourTrailsTable . " tt
                    JOIN " . self::trailsTable . " t ON tt.trailid = t.trailid
                    WHERE tt.tourid = '$tourid' AND t.collegeid = '$collegeid' AND tt.collegeid = '$collegeid'";
    	$result = $mysqli->query($query);
    	$data = array();
    	if ($result) {
    		while($row = $result->fetch_assoc()){
    			$data[] = new WalkingTour($row);
    		}
    		$result->free();
    	}
    	$mysqli->close();
    	return $data;
    }
    
    /**
    * Gets a list of available trails based on $collegeid
    *
    * @static    
    * @param string $collegeid
    * @return array array of WalkingTour objects
    */
    public static function getAvailableTrailsByCollege($collegeid) {
    	$mysqli = self::getMysqliInstance();
    	$query = "SELECT *
                        FROM " . self::trailsTable . " WHERE trailid NOT IN
				    	(SELECT trailid from tour_trails WHERE collegeid = '$collegeid')
				    	AND collegeid = '$collegeid'";

    	$result = $mysqli->query($query);
    	$data = array();
    	if ($result) {
    		while($row = $result->fetch_assoc()){
    			$data[] = new WalkingTour($row);
    		}
    		$result->free();
    	}
 	
    	$mysqli->close();
    	return $data;
    }
    
    /**
     * Delete a given tour and its trials from tables based on $tourid
     * 
     * @param string $tourid
     * @param string $collegeid
     * @return bool
     */
    public static function delete($tourid, $collegeid) {
    	$mysqli = self::getMysqliInstance();
    	$mysqli->autocommit(FALSE);
    	$trailIDs = array();
    	
    	// get trail IDs associated with that tourid
    	$trails = self::getTrailsByTourAndCollege($tourid, $collegeid);    	
    	foreach ($trails as $trail) {
    		$trailIDs[] = $trail->trailid;
    	}
    	
    	if (!empty($trailIDs)) {
    		$idStr =  "'" . implode("','", $trailIDs) . "'";
	    	//delete tour_trails
	    	$sql = "DELETE FROM " . self::tourTrailsTable . " WHERE tourid = ? AND collegeid = ? AND trailid IN ($idStr)";
	    	if ($stmt = $mysqli->prepare($sql)) {
	    		$stmt->bind_param('ss', $tourid, $collegeid);
	    		if(!$stmt->execute()){
	    			$stmt->close();
	    			$mysqli->rollback();    			
	    			return false;
	    		}
	    		$stmt->close();
	    	} else {
	    		$mysqli->rollback();
	    		echo 'Unable to prepare statement: ' . $mysqli->error;
	    		return false;
	    	}
    	}
    	
    	//delete tours
    	
    	$sql = "DELETE FROM " . self::toursTable . " WHERE tourid = ? AND collegeid = ?";
    	if ($stmt = $mysqli->prepare($sql)) {
    		$stmt->bind_param('ss', $tourid, $collegeid);
    		if(!$stmt->execute()){
    			$stmt->close();
    			$mysqli->rollback();    			
    			return false;
    		}
    		$stmt->close();
    	} else {
    		$mysqli->rollback();
    		echo 'Unable to prepare statement: ' . $mysqli->error;
    		return false;
    	}
    	$mysqli->commit();
    	$mysqli->close();
    	
    	return true;
    }
    
    /**
    * Delete a given trail from tables based on $trailid
    *
    * @param string $trail
    * @param string $collegeid
    * @return bool
    */
    public static function deleteTrail($trailid, $collegeid) {
    	$mysqli = self::getMysqliInstance();
    	$mysqli->autocommit(FALSE);
    	$trailIDs = array();    	     
    	 
    	// delete trails
    	$sql = "DELETE FROM " . self::trailsTable . " WHERE trailid IN (?) AND collegeid = ?";
    	
    	if ($stmt = $mysqli->prepare($sql)) {
    		$stmt->bind_param('ss', $trailid, $collegeid);
    		if(!$stmt->execute()){
    			$stmt->close();
    			$mysqli->rollback();
    			return false;
    		}
    		$stmt->close();
    	} else {
    		$mysqli->rollback();
    		echo 'Unable to prepare statement: ' . $mysqli->error;
    		return false;
    	}
    	 
    	//delete tour_trails
    	$sql = "DELETE FROM " . self::tourTrailsTable . " WHERE collegeid = ? AND trailid IN (?)";
    	if ($stmt = $mysqli->prepare($sql)) {
    		$stmt->bind_param('ss', $collegeid, $trailid);
    		if(!$stmt->execute()){
    			$stmt->close();
    			$mysqli->rollback();
    			return false;
    		}
    		$stmt->close();
    	} else {
    		$mysqli->rollback();
    		echo 'Unable to prepare statement: ' . $mysqli->error;
    		return false;
    	}
    	     	
    	$mysqli->commit();
    	$mysqli->close();
    
    	return true;
    }
    
    /**
    * Delete a given tour_trail from tables based on $trailid
    * and $tourid
    * @param string $trailids
    * @return bool
    */
    public function unassignTrails($trailIds) {
    	$mysqli = self::getMysqliInstance();    	
    	$idStr =  "'" . implode("','", $trailIds) . "'";
    	//delete tour_trails
    	$sql = "DELETE FROM " . self::tourTrailsTable . " WHERE tourid = ? AND collegeid = ? AND trailid IN ($idStr)";
    	if ($stmt = $mysqli->prepare($sql)) {
    		$stmt->bind_param('ss', $this->tourid, $this->collegeid);
    		if(!$stmt->execute()){
    			$stmt->close();    	
    			return false;
    		}
    		$stmt->close();
    	} else {
    		echo 'Unable to prepare statement: ' . $mysqli->error;
    		return false;
    	}
    	     	
    	$mysqli->close();
    
    	return true;
    }
    
    /**
    * Assign a given tour_trail in table based on $trailid
    * 
    * @param string $trails    
    * @return bool
    */
    public function assignTrails($trailIds = array()) {
    	$mysqli = self::getMysqliInstance();    	
    	foreach ($trailIds as $trailid) {
    		$trailid = mysql_real_escape_string($trailid);
    		//check if trail is already assigned to this tour
    		$sql = "SELECT * FROM " . self::tourTrailsTable . " WHERE tourid = '$this->tourid' AND trailid = '$trailid'";
    		$result = $mysqli->query($sql);
    		if ($result->num_rows == 0) {
    			//echo "$tourid, $trailid, $collegeid";exit;
    			$sql = "INSERT INTO " . self::tourTrailsTable . " (tourid,trailid,collegeid) VALUES (?,?,?)";
    			if ($stmt = $mysqli->prepare($sql)) {
    				$stmt->bind_param('sss', $this->tourid, $trailid, $this->collegeid);
    				if(!$stmt->execute()){
    					$stmt->close();
    					echo 'Unable to execute statement: 111--' .$trailid. $mysqli->error;exit;
    					return false;
    				}
    				$stmt->close();
    			} else {
    				echo 'Unable to prepare statement: 222---' . $trailid.$mysqli->error;exit;
    				return false;
    			}    		
    		} 
    	}        	
    	$mysqli->close();    
    	return true;
    }
    
    public function setFields($fields) {
    	foreach ($fields as $field => $value) {
    		$this->$field = $value;
    	}
    }
}

?>

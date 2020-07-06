<?php

namespace Wiloke\Core\Database;

class QueryBuilder
{
    /**
     * @var \mysqli
     */
    private $oDb;
    private $table;
    private $errMsg;
    private static $self;
    private $what = '*';
    private $where;
    private $limit;
    private $whereConcat = '';
    /**
     * @var \mysqli_result
     */
    private $query;
    private static $count = 1;
    
    public function __construct()
    {
        try {
            $this->oDb = Connection::make();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }
    }
    
    private function reset()
    {
        $this->where       = '';
        $this->what        = '*';
        $this->limit       = '';
        $this->whereConcat = '';
        $this->errMsg      = '';
        
        return $this;
    }
    
    public static function table($table)
    {
        if (!self::$self) {
            self::$self = new self();
        }
        
        self::$count = self::$count + 1;
        
        self::$self->reset();
        self::$self->table = $table;
        
        return self::$self;
    }
    
    public static function getError()
    {
        return self::$self->errMsg;
    }
    
    public static function getId()
    {
        return self::$self->oDb->insert_id;
    }
    
    private function query($sql)
    {
        $this->query = $this->oDb->query($sql);
        if (!$this->query) {
            $this->errMsg = sprintf('Error: %s %s', $sql, $this->oDb->error);
            
            return false;
        }
        
        return true;
    }
    
    public function insert($aInfo)
    {
        $aColumns = array_keys($aInfo);
        $aValues  = array_values($aInfo);
       
        $parseColumns = implode(',', $aColumns);
        $aValues      = '"'.implode('","', $aValues).'"';
    
        $sql          = sprintf('INSERT INTO %s(%s) VALUES(%s)', $this->table, $parseColumns, $aValues);
        
        return $this->query($sql);
    }
    
    public function select(...$what)
    {
        $this->what = implode(',', $what);
        
        return $this;
    }
    
    public function where($key, $operatorOrValue = '', $maybeValue = '')
    {
        if (empty($maybeValue)) {
            $value    = $operatorOrValue;
            $operator = '=';
        } else {
            $value    = $maybeValue;
            $operator = $operatorOrValue;
        }
        
        $value = is_numeric($value) ? $value : '"'.$value.'"';
        
        if (!empty($this->where)) {
            $this->where .= $this->whereConcat.$this->oDb->real_escape_string($key).$operator
                            .$this->oDb->real_escape_string($value);
        } else {
            $this->where = $this->oDb->real_escape_string($key).$operator.$this->oDb->real_escape_string($value);
        }
        
        return $this;
    }
    
    public function orWhere($key, $operatorOrValue = '', $maybeValue = '')
    {
        $this->whereConcat = ' OR ';
        
        return $this->where($key, $operatorOrValue, $maybeValue);
    }
    
    public function andWhere($key, $operatorOrValue = '', $maybeValue = '')
    {
        $this->whereConcat = ' AND ';
        
        return $this->where($key, $operatorOrValue, $maybeValue);
    }
    
    public function get()
    {
        $sql = sprintf('SELECT %s FROM %s', $this->what, $this->table);
        
        if ($this->where) {
            $sql .= sprintf(' WHERE %s', $this->where);
        }
        
        if ($this->limit) {
            $sql .= sprintf(' LIMIT %s', $this->limit);
        }
        

        $status = $this->query($sql);
        
        if ($status) {
            $aResults = [];
            if ($this->query->num_rows > 0) {
                while ($aRow = $this->query->fetch_assoc()) {
                    $aResults[] = $aRow;
                }
            }
            
            return $aResults;
        }
        
        return false;
    }
    
    public function first()
    {
        $this->limit = 1;
        $aResults    = $this->get();
        if (empty($aResults)) {
            return $aResults;
        }
        
        return $aResults[0];
    }
    
    public function __destruct()
    {
        $this->oDb->close();
    }
}

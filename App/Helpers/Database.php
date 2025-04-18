<?php

class Database
{
	private ?string $db = NULL;
	private ?PDO $pdo = NULL;

	function __construct ($name)
    {
		try
        {
			$this->setDb($name);

			$this->pdo = new PDO("sqlite:".$this->db);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $err)
        {
            echo "DB ERROR: ".$err->getMessage();
        }
    }

    function __destruct ()
    {
        $this->pdo = NULL;
    }

    function query (string $cmd, array $args = []): array
    {
        $res = $this->pdo->prepare($cmd);

        if(!empty($args))
        {
            foreach($args as $param => $value)
            {
                $res->bindParam($param, $value, PDO::PARAM_STR);
            }
        }

        $res->execute();

        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    function exec (string $cmd, array $args = []): bool|string
    {
        $res = $this->pdo->prepare($cmd);
        $this->pdo->beginTransaction();

        if(!empty($args))
        {
            foreach($args as $param => $value)
            {
                $res->bindParam($param, $value, PDO::PARAM_STR);
            }
        }

        try
        {
            return $res->execute();
        }
        catch(Exception $ex)
        {
			$this->rollback();
			return $ex->getMessage();
        }
    }

	function commit (): void
	{
		$this->pdo->commit();
	}

	function rollback (): void
	{
		$this->pdo->rollback();
	}

	protected function setDb ($name)
	{
		$this->db = $name;
	}
}

?>
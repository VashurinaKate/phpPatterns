<?php

abstract class AbstractDB {
    abstract public function DBConnection() : Connection;
    abstract public function DBRecord() : Record;
    abstract public function DBQueryBuilder() : Query;
}

class MySQLFactory extends AbstractDB {
    public function DBConnection() : Connection {
        return new MySQLConnection();
    }

    public function DBRecord() : Record {
        return new MySQLRecord();
    }

    public function DBQueryBuilder() : Query {
        return new MySQLQuery();
    }
}

class PostgreSQLFactory extends AbstractDB {
    public function DBConnection() : Connection {
        return new PostgreSQLConnection();
    }

    public function DBRecord() : Record {
        return new PostgreSQLRecord();
    }

    public function DBQueryBuilder() : Query {
        return new PostgreSQLQuery();
    }
}

class OracleFactory extends AbstractDB {
    public function DBConnection() : Connection {
        return new OracleConnection();
    }

    public function DBRecord() : Record {
        return new OracleRecord();
    }

    public function DBQueryBuilder() : Query {
        return new OracleQuery();
    }
}

interface Connection {
    public function createConnect() : string;
}

class MySQLConnection implements Connection {
    public function createConnect() : string {
        return "Successesfully connected to MySQL DB!";
    }
}

class PostgreSQLConnection implements Connection {
    public function createConnect() : string {
        return "Successesfully connected to PostgreSQL DB!";
    }
}

class OracleConnection implements Connection {
    public function createConnect() : string {
        return "Successesfully connected to Oracle DB!";
    }
}

interface Record {
    public function createRecord() : string;
}

class MySQLRecord implements Record {
    public function createRecord() : string {
        return "Created new record to MySQL DB!";
    }
}

class PostgreSQLRecord implements Record {
    public function createRecord() : string {
        return "Created new record to PostgreSQL DB!";
    }
}

class OracleRecord implements Record {
    public function createRecord() : string {
        return "Created new record to Oracle DB!";
    }
}

interface Query {
    public function createQuery() : string;
}

class MySQLQuery implements Query {
    public function createQuery() : string {
        return "Created query to MySQL DB!";
    }
}

class PostgreSQLQuery implements Query {
    public function createQuery() : string {
        return "Created query to PostgreSQL DB!";
    }
}

class OracleQuery implements Query {
    public function createQuery() : string {
        return "Created query to Oracle DB!";
    }
}

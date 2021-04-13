<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use App\Models\Database;
final class DatabaseTest extends TestCase
{
    public function testCannotSelectUser(): void
    {
        $this->expectException(InvalidArgumentException::class);

        
        $dbType = 'mysql';
        $dbHost = 'mysql57';
        $dbUser = 'root';
        $dbPass = 'rootpassword';
        $dbName = 'mvl';

        $db = new \App\Models\Database($dbType, $dbHost, $dbUser, $dbPass, $dbName);
        $sql = 'select * from users LIMIT 5';
        $this->assertEquals($db->CountNumRowsSQL($sql), 5);
    }
}

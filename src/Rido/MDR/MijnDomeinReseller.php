<?php namespace Rido\MDR;

/**
 * Class MijnDomeinReseller
 *
 * @package Rido\MDR
 */
class MijnDomeinReseller
{
    /**
     * AuthType
     *
     * @var string
     */
    protected $authType = 'md5';

    /**
     * Username
     *
     * @var string
     */
    protected $username;

    /**
     * Password
     *
     * @var string
     */
    protected $password;

    /**
     * API Hostname
     *
     * @var string
     */
    protected $host = "manager.mijndomeinreseller.nl";

    /**
     * API URL
     *
     * @var string
     */
    protected $url = "/api/?";

    /**
     * Use SSL
     *
     * @var bool
     */
    protected $useSSL = true;

    /**
     * Post string
     *
     * @var string
     */
    protected $postString;

    /**
     * Raw data
     *
     * @var string
     */
    protected $rawData;

    /**
     * Values
     *
     * @var string
     */
    protected $values;

    /**
     * MijnDomeinReseller constructor.
     *
     * @param            $username
     * @param            $password
     * @param bool|false $passwordIsMd5
     */
    public function __construct($username, $password, $passwordIsMd5 = false)
    {
        // Store username
        $this->username = $username;

        // Store password
        $this->password = $passwordIsMd5 ? $password : md5($password);
    }

    public function newRequest()
    {
        // Clear out all previous values
        $this->postString = "";
        $this->rawData = "";
        $this->values = "";
    }

    public function addError($error)
    {
        // Add an error to the result list
        $this->values["errcount"] = "1";
        $this->values["Err1"] = $error;
    }

    public function parseResponse($buffer)
    {
        // Parse the string into lines
        $Lines = explode("\n", $buffer);

        // Get # of lines
        $NumLines = count($Lines);

        // Skip past header
        $i = 0;
        while (trim($Lines[$i]) != "") {
            $i = $i + 1;
        }

        $StartLine = $i;

        // Parse lines
        $GotValues = 0;
        for ($i = $StartLine; $i < $NumLines; $i ++) {
            // Is this line a comment?
            if (substr($Lines[$i], 1, 1) != ";") {
                // It is not, parse it
                $Result = explode("=", $Lines[$i]);


                // Make sure we got 2 strings
                if (count($Result) >= 2) {

                    // Trim whitespace and add values
                    $name = trim($Result[0]);
                    $value = trim($Result[1]);
                    $this->values[$name] = $value;

                    // Was it an errcount value?
                    if ($name == "errcount") {
                        // Remember this!
                        $GotValues = 1;
                    }
                }
            }
        }

        if ($GotValues == 0) {
            // We didn't, so add an error message
            $this->addError("Could not connect to Server -Please try again Later");
        }
    }

    public function addParam($Name, $Value)
    {
        // URL encode the value and add to PostString
        $this->postString = $this->postString . $Name . "=" . urlencode($Value) . "&";
    }

    public function doTransaction()
    {
        if ($this->username != "" && $this->password != "" && $this->authType != "") {
            $this->AddParam("user", $this->username);
            $this->AddParam("pass", $this->password);
            $this->AddParam("authtype", $this->authType);
        }

        $Values = "";

        if ($this->useSSL) {
            $port = 443;
            $address = gethostbyname($this->host);
            $socket = fsockopen("ssl://" . $this->host, $port);
        }
        else {
            $port = 80;
            $address = gethostbyname($this->host);
            $socket = fsockopen($this->host, $port, $errno, $errstr, 30);
        }
        if (!$socket) {
            function strerror()
            {
                echo "Could not connect to Server -Please try again Later ($errno, $errstr)";
            }

            $this->addError("socket() failed: " . strerror($socket));
        }
        else {
            // Send GET command with our parameters
            $out = '';

            $in = "GET " . $this->url . $this->postString . " HTTP/1.0\r\n";
            $in .= "Host: " . $this->host . "\r\n";
            $in .= "Connection: Close\r\n\r\n";

            fputs($socket, $in);

            // Read response
            while ($out = fread($socket, 2048)) {
                // Save in rawdata
                $this->rawData .= $out;
            }
            // Close the socket
            fclose($socket);

            // Parse the output for name=value pairs
            $this->parseResponse($this->rawData);
        }
    }

    public function getRequest()
    {
        return $this->postString;
    }
}

?>
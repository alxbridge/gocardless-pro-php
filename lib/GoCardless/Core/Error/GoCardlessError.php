<?php

namespace GoCardless\Core\Error;

/**
  * Core GoCardless Error
  *
  * @package GoCardless\Core
  * @subpackage Error
  */
class GoCardlessError extends \Exception
{
    /**
      * @var \Exception $error raw error object
      * @var int $http_status The http status response number.
      */
    private $error;
    private $http_status;

    /**
      * @param \Exception $error we just were talking about yesterday.
      * @param int $http_status The status response from the http server.
      */
    public function __construct($error, $http_status)
    {
        $this->error = $error;
        $this->http_status = $http_status;
    
        if (is_object($error)) {
            $message = $error->error->message;
            if ($error->error->documentation_url) {
                $message .= (', see ' . $error->error->documentation_url);
            }
        } else {
            $message = (string)$error;
        }
        parent::__construct($message);
    }

    /**
      * Factory for GoCardlessError and it's subclasses.
      * @return GoCardlessError|InvalidApiUsageError|InvalidStateError|ValidationFailedError
      */
    public static function makeApiError($error, $status)
    {
        if (is_object($error) && isset($error->error) && isset($error->error->type)) {
            switch ($error->error->type) {
                case 'invalid_api_usage':
                    return new InvalidApiUsageError($error, $status);

                case 'invalid_state':
                    return new InvalidStateError($error, $status);

                case 'validation_failed':
                    return new ValidationFailedError($error, $status);
            }
        }
        return new GoCardlessError($error, $status);
    }

    /** @see GoCardlessError::$error */
    public function error()
    {
        return $this->error->error;
    }

    /**
      * Get all http errors (includes a list of objects with a required 
      * reason and message, and optional links properties).
      *
      * @return array[mixed] List of validation errors from the api
      * @see https://developer.gocardless.com/pro/#errors-invalid-api-usage-errors
      */
    public function errors()
    {
        return $this->error->error->errors;
    }

    /**
      * Gets the error's documentation url if it exists.
      *
      * @return string|null
      */
    public function documentation_url()
    {
      if (isset($this->error()->documentation_url)) {
        return $this->error()->documentation_url;
      }
      return null;
    }

    /**
      * Gets the server's http status.
      *
      * @see GoCardlessError::$http_status
      * @return int
      */
    public function http_status()
    {
        return $this->http_status;
    }
}

<?php
namespace Controller;

use Model\Way;
use Phalcon\Http\Request;
use Phalcon\Http\Response;
use Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;
use Phalcon\Mvc\Model\Transaction\Failed as TransactionFailed;
use Exception;

class Ways
{
    public function getAll()
    {
        return Way::find();
    }

    public function getRoute($id = null)
    {
        $response = new Response();

        try {
            if ($id === null) {
                throw new Exception("Bad Request", 400);
            }

            return Way::findFirst($id);
        } catch (TransactionFailed $e) {
            $response->setStatusCode(400, "Bad Request")->setContent($e->getMessage())->sendHeaders();
        } catch (Exception $e) {
            $response->setStatusCode(404, "Not Found")->setContent($e->getMessage())->sendHeaders();
        }

        return $response;
    }

    public function create($json = array())
    {
        $response = new Response();

        try {
            if (empty($json)) {
                throw new Exception("Bad Request", 400);
            }

            $objTransactionManager = new TransactionManager();
            $objTransaction = $objTransactionManager->get();

            $objRoute = new Way();
            $objRoute->setLatFrom($json['lat_from']);
            $objRoute->setLgtFrom($json['lgt_from']);
            $objRoute->setLatTo($json['lat_to']);
            $objRoute->setLgtTo($json['lgt_to']);
            $objRoute->setVehicle($json['vehicle']);
            $objRoute->setDateTime($json['date_time']);
            $objRoute->setFavorite($json['favorite']);
            $objRoute->setIdProfile($json['id_profile']);

            if ($objRoute->create() === false) {
                $objTransaction->rollback();
            }
            $objTransaction->commit();

            return $objRoute;
        } catch (TransactionFailed $e) {
            $response->setStatusCode(400, "Bad Request")->setContent($e->getMessage())->sendHeaders();
        } catch (Exception $e) {
            $response->setStatusCode(400, "Bad Request")->setContent($e->getMessage())->sendHeaders();
        }

        return $response;
    }

    public function update($id, $json = array())
    {
        $response = new Response();

        try {
            if ($id === null || empty($json)) {
                throw new Exception("Bad Request", 400);
            }

            $objTransactionManager = new TransactionManager();
            $objTransaction = $objTransactionManager->get();

            $objRoute = Way::findFirst($id);

            if ($objRoute === false) {
                throw new Exception("Not Found", 404);
            }

            if (isset($json['lat_from'])) {
                $objRoute->setLatFrom($json['lat_from']);
            }

            if (isset($json['lgt_from'])) {
                $objRoute->setLgtFrom($json['lgt_from']);
            }

            if (isset($json['lat_to'])) {
                $objRoute->setLatTo($json['lat_to']);
            }

            if (isset($json['lgt_to'])) {
                $objRoute->setLgtTo($json['lgt_to']);
            }

            if (isset($json['vehicle'])) {
                $objRoute->setVehicle($json['vehicle']);
            }

            if (isset($json['date_time'])) {
                $objRoute->setDateTime($json['date_time']);
            }

            if (isset($json['favorite'])) {
                $objRoute->setFavorite($json['favorite']);
            }

            if (isset($json['id_profile'])) {
                $objRoute->setIdProfile($json['id_profile']);
            }

            if ($objRoute->update() === false) {
                $objTransaction->rollback();
            }
            $objTransaction->commit();

            return $objRoute;
        } catch (TransactionFailed $e) {
            $response->setStatusCode(400, "Bad Request")->setContent($e->getMessage())->sendHeaders();
        } catch (Exception $e) {
            $response->setStatusCode($e->getCode(), $e->getMessage())->setContent($e->getMessage())->sendHeaders();
        }

        return $response;
    }
}

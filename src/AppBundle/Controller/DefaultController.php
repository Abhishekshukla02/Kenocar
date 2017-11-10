<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations as Rest;
use \DateTime;
Use AppBundle\Entity\Customer;
Use AppBundle\Entity\Cars;

class DefaultController extends FOSRestController
{
    //create customer api
    public function createCustomerAction(Request $request)
    {
        $resultArr = array();
        $em = $this->getDoctrine()->getManager();
        //get user input
        $username = $request->get('username');
        $password = $request->get('password');
        $customername = $request->get('customername');
        $customeremail = $request->get('customeremail');
        if(empty($username) || empty($password) || empty($customername) || empty($customeremail)){        
            $output = array(
                'data' => $resultArr,
                'message' => 'Required fields cannot be blank',
                'status' => 'fail',
                'statusCode' => '200'
            );
            $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
            return new Response($serializedEntity);    
        }

        $objAdmin = $em->getRepository('AppBundle:Admin')->findOneBy(array('username'=>$username,'password'=>$password));
        if(!is_object($objAdmin)){
            $output = array(
            'data' => $resultArr,
            'message' => 'Username password incorrect.',
            'status' => 'fail',
            'statusCode' => '200'
            );
            $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
            return new Response($serializedEntity);    
        }

        //create customer
        $customer = new Customer();
        $customer->setName($customername);
        $customer->setEmail($customeremail);
        $customer->setIsActive('Active');
        $customer->setCreatedat(new DateTime());
        $customer->setUpdatedat(new DateTime());
        $em->persist($customer);
        $em->flush();

        $output = array(
            'data' => $resultArr,
            'message' => 'customer created successfully.',
            'status' => 'success',
            'statusCode' => '200'
        );
        $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
        return new Response($serializedEntity);    
    }

    //create Car api
    public function createCarAction(Request $request)
    {
        $resultArr = array();
        $em = $this->getDoctrine()->getManager();
        //get user input
        $username = $request->get('username');
        $password = $request->get('password');
        $carname = $request->get('carname');
        $carmodel = $request->get('carmodel');
        $customer = $request->get('customer');

        if(empty($username) || empty($password) || empty($carname) || empty($carmodel)){        
            $output = array(
                'data' => $resultArr,
                'message' => 'Required fields cannot be blank',
                'status' => 'fail',
                'statusCode' => '200'
            );
            $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
            return new Response($serializedEntity);    
        }

        $objAdmin = $em->getRepository('AppBundle:Admin')->findOneBy(array('username'=>$username,'password'=>$password));
        if(!is_object($objAdmin)){
            $output = array(
            'data' => $resultArr,
            'message' => 'Username password incorrect.',
            'status' => 'fail',
            'statusCode' => '200'
            );
            $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
            return new Response($serializedEntity);    
        }

        //create customer
        $car = new Cars();
        $car->setCustomer(null);
        $car->setCarname($carname);
        $car->setCarmodel($carmodel);
        $car->setIsDeleted('No');
        $car->setCreatedat(new DateTime());
        $car->setUpdatedat(new DateTime());
        $em->persist($car);
        $em->flush();

        $output = array(
            'data' => $resultArr,
            'message' => 'Car created successfully.',
            'status' => 'success',
            'statusCode' => '200'
        );
        $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
        return new Response($serializedEntity);    
    }

    //add customer car
    public function addCustomerCarAction(Request $request)
    {
        $resultArr = array();
        $em = $this->getDoctrine()->getManager();
        //get user input
        $username = $request->get('username');
        $password = $request->get('password');
        $carname = $request->get('carname');
        $carmodel = $request->get('carmodel');
        $customer = $request->get('customer');

        if(empty($username) || empty($password) || empty($carname) || empty($carmodel) || empty($customer)){        
            $output = array(
                'data' => $resultArr,
                'message' => 'Required fields cannot be blank',
                'status' => 'fail',
                'statusCode' => '200'
            );
            $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
            return new Response($serializedEntity);    
        }

        $objAdmin = $em->getRepository('AppBundle:Admin')->findOneBy(array('username'=>$username,'password'=>$password));
        if(!is_object($objAdmin)){
            $output = array(
            'data' => $resultArr,
            'message' => 'Username password incorrect.',
            'status' => 'fail',
            'statusCode' => '200'
            );
            $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
            return new Response($serializedEntity);    
        }

        $objCusto = $em->getRepository('AppBundle:Customer')->find($customer);
        if(!is_object($objAdmin)){
            $output = array(
            'data' => $resultArr,
            'message' => 'Customer not found.',
            'status' => 'fail',
            'statusCode' => '200'
            );
            $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
            return new Response($serializedEntity);    
        }


        //create customer
        $car = new Cars();
        $car->setCustomer($objCusto);
        $car->setCarname($carname);
        $car->setCarmodel($carmodel);
        $car->setIsDeleted('No');
        $car->setCreatedat(new DateTime());
        $car->setUpdatedat(new DateTime());
        $em->persist($car);
        $em->flush();

        $output = array(
            'data' => $resultArr,
            'message' => 'Car created successfully.',
            'status' => 'success',
            'statusCode' => '200'
        );
        $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
        return new Response($serializedEntity);    
    }


        //add customer car
    public function getCustomerCarAction(Request $request)
    {
        $resultArr = array();
        $em = $this->getDoctrine()->getManager();
        //get user input
        $username = $request->get('username');
        $password = $request->get('password');
        $customer = $request->get('customer');

        if(empty($username) || empty($password) || empty($customer)){        
            $output = array(
                'data' => $resultArr,
                'message' => 'Required fields cannot be blank',
                'status' => 'fail',
                'statusCode' => '200'
            );
            $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
            return new Response($serializedEntity);    
        }

        $objAdmin = $em->getRepository('AppBundle:Admin')->findOneBy(array('username'=>$username,'password'=>$password));
        if(!is_object($objAdmin)){
            $output = array(
            'data' => $resultArr,
            'message' => 'Username password incorrect.',
            'status' => 'fail',
            'statusCode' => '200'
            );
            $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
            return new Response($serializedEntity);    
        }

        $objCusto = $em->getRepository('AppBundle:Customer')->find($customer);
        if(!is_object($objAdmin)){
            $output = array(
            'data' => $resultArr,
            'message' => 'Customer not found.',
            'status' => 'fail',
            'statusCode' => '200'
            );
            $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
            return new Response($serializedEntity);    
        }

        $userCar = $em->getRepository('AppBundle:Cars')->findBy(array('customer'=>$customer));
        if(count($userCar)>0){
            foreach ($userCar as $key => $value) {
                $resultArr['car'][$key] = $value->getCarname();    
            }
            $msg = "Car list";
        }else{
            $msg = "No car found";
        }        


        $output = array(
            'data' => $resultArr,
            'message' => $msg,
            'status' => 'success',
            'statusCode' => '200'
        );
        $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
        return new Response($serializedEntity);    
    }


        //add customer car
    public function deleteCarAction(Request $request)
    {
        $resultArr = array();
        $em = $this->getDoctrine()->getManager();
        //get user input
        $username = $request->get('username');
        $password = $request->get('password');
        $customer = $request->get('customer');
        $car = $request->get('car');

        if(empty($username) || empty($password) || empty($customer) || empty($car)){        
            $output = array(
                'data' => $resultArr,
                'message' => 'Required fields cannot be blank',
                'status' => 'fail',
                'statusCode' => '200'
            );
            $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
            return new Response($serializedEntity);    
        }

        $objAdmin = $em->getRepository('AppBundle:Admin')->findOneBy(array('username'=>$username,'password'=>$password));
        if(!is_object($objAdmin)){
            $output = array(
            'data' => $resultArr,
            'message' => 'Username password incorrect.',
            'status' => 'fail',
            'statusCode' => '200'
            );
            $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
            return new Response($serializedEntity);    
        }

        $objCusto = $em->getRepository('AppBundle:Customer')->find($customer);
        if(!is_object($objAdmin)){
            $output = array(
            'data' => $resultArr,
            'message' => 'Customer not found.',
            'status' => 'fail',
            'statusCode' => '200'
            );
            $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
            return new Response($serializedEntity);    
        }

        $userCar = $em->getRepository('AppBundle:Cars')->findOneBy(array('customer'=>$customer,'id'=>$car));
        if(is_object($userCar)){
            $userCar->setIsDeleted('Yes');
            $em->persist($userCar);
            $em->flush();
            $msg = "Car deleted";
        }else{
            $msg = "No car found";
        }

        $output = array(
            'data' => $resultArr,
            'message' => $msg,
            'status' => 'success',
            'statusCode' => '200'
        );
        $serializedEntity = $this->container->get('serializer')->serialize($output, 'json');
        return new Response($serializedEntity);    
    }


}

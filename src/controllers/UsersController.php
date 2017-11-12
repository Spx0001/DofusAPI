<?php

namespace dofus\controllers;

use dofus\models\Accounts;
use dofus\models\AccountsInformations;
use dofus\models\Answers;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator;
use dofus\utils\Picker;

class UsersController
{

    public function register(RequestInterface $request, ResponseInterface $response, $args)
    {
        $params = $request->getParams();
        if (!is_null($params)) {
            $errors = [];

            $registerFrom = $params['registerFrom'];
            $validRegister1 = $params['validRegister1'];
            if (strcmp($registerFrom, 'game_dofus') == 0 && $validRegister1 == true) {
                $loginAG = $params['loginAG'];
                $passAG = $params['passAG'];
                $passAG2 = $params['passAG2'];
                $email = $params['email'];

                $lastName = $params['lastname'];
                $firstName = $params['firstname'];

                $birthDateDay = $params['datenaiss_d'];
                $birthDateMonth = $params['datenaiss_m'];
                $birthDateYear = $params['datenaiss_y'];

                $sex = $params['sexe'];
                $knowgameid = $params['knowgameid'];
                $valid_newsletter = $params['valid_newsletter'];

                $question = $params['question'];
                $answer = $params['answer'];
                $verifCode = $params['verifCode'];

                $lang = $params['lang'];
                $country = $params['pays'];
                $community = $params['community_id'];

                $user = Accounts::where('username', '=', $loginAG)->first();
                if (!is_null($user)) {
                    $errors[] = 'Votre nom de compte est déjà utilisé.';
                }

                $nickname = Accounts::where('nickname', '=', $loginAG)->first();
                if (!is_null($nickname)) {
                    $errors[] = 'Votre nom de compte est déjà utilisé.';
                }

                $user = Accounts::where('email', '=', $email)->first();
                if (!is_null($user)) {
                    $errors[] = 'L\'email est déjà utilisé.';
                }

                if (!Validator::email()->validate($email)) {
                    $errors[] = 'Emil non valide.';
                }

                if ($passAG != $passAG2) {
                    $errors[] = "Les deux mots de passe ne sont pas identique.";
                }

                if (strcmp($passAG, $loginAG) == 0) {
                    $errors[] = "Votre mot de passe doit être différent de votre nom de compte.";
                }

                if (strcmp($question, $answer) == 0) {
                    $errors[] = "Votre question secrète ne peut-être identique à la réponse secrète.";
                }

                if (!password_verify($verifCode, $_SESSION['verifCode'])) {
                    $errors[] = "Code de sécurité erroné.";
                }

                if (empty($errors)) {
                    $account = Accounts::create([
                        'username' => $loginAG,
                        'password' => hash('sha512', $passAG),
                        'nickname' => '',
                        'email' => $email,
                        'secretQuestion' => $question,
                        'secretAnswer' => $answer,
                        'subscribeTime' => 0,
                        'community' => $community
                    ]);
                    AccountsInformations::create([
                        'accountId' => $account->id,
                        'firstName' => $firstName,
                        'lastName' => $lastName,
                        'birthDate' => $birthDateYear . '-' . $birthDateMonth . '-' . $birthDateDay,
                        'sex' => $sex,
                        'lang' => $lang,
                        'newsletter' => $valid_newsletter,
                        'knowGame' => $knowgameid,
                        'country' => $country
                    ]);
                    unset($_SESSION['verifCode']);
                    return "result=Inscription réussie avec succès.&";
                } else {
                    $errorMessage = 'result=';
                    foreach ($errors as $error) {
                        $errorMessage .= $error . '<br />';
                    }
                    return $errorMessage . '&';
                }
            } else {
                return "result=Une erreur est survenue dans l'envoie du formulaire d'inscription.&";
            }
        } else {
            return "result=Impossible de traiter les données.&";
        }
    }

    public function registrationComeFrom(RequestInterface $request, ResponseInterface $response, $args)
    {
        $answers = Answers::where('cmntt', '=', $args['cmntt'])->get();;
        $str = 'answer_count=' . count($answers);
        $i = 1;
        foreach ($answers as $answer) {
            $str .= "&answer_id{$i}={$i}&answer_desc{$i}={$answer->answer}";
            $i++;
        }
        return $str;
    }

    public function captcha(RequestInterface $request, ResponseInterface $response, $args)
    {
        $captcha = substr(sha1(uniqid()), 0, 6);
        $_SESSION['verifCode'] = password_hash($captcha, PASSWORD_DEFAULT, ['cost' => 10]);;
        $image = imagecreatetruecolor(250, 60);
        imagefilledrectangle($image, 0, 0, 250, 60, imagecolorallocate($image, 100, 204, 204));
        $color = imagecolorallocate($image, 51, 51, 150);
        for ($i = 0; $i < 5; $i++) {
            imageline($image, 0, (rand() % 60), 250, (rand() % 60), $color);
        }
        for ($i = 0; $i < 1000; $i++) {
            imagesetpixel($image, (rand() % 250), (rand() % 60), $color);
        }
        $font = ASSETS . DS . 'toony_loons.ttf';
        $x = rand(10, 100);
        $angle = mt_rand(10, 40);
        for ($i = 0; $i < strlen($captcha); $i++) {
            $size = rand(15, 20);
            $color = imagecolorallocate($image, 0, 0, 0);
            $y = rand(30, 50);
            imagettftext($image, $size, $angle, ($x + (20 * $i)), $y, $color, $font, $captcha[$i]);
        }
        imagepng($image);
        imagedestroy($image);
        return $response->withHeader('Content-type', 'image/png');
    }

}

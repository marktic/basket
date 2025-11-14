<?php

declare(strict_types=1);

namespace Marktic\Basket\Carts\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\Entities\HasRepository;
use Marktic\Basket\Carts\Models\Cart;
use Marktic\Basket\Carts\Models\Carts;
use Marktic\Basket\Utility\BasketModels;
use Nip\Records\AbstractModels\RecordManager;
use Nip\Utility\Uuid;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method Carts getRepository()
 */
class FindOrInitCurrentCart extends Action
{
    use HasRepository;

    public const CART_REQUEST_KEY = '_cart';

    protected Request $request;

    public static function forRequest(Request $request): FindOrInitCurrentCart
    {
        $action = new self();
        $action->request = $request;
        return $action;
    }

    public function fetch()
    {
        $cart = $this->find();
        if ($cart) {
            return $cart;
        }
        return $this->create();
    }

    protected function find(): ?Cart
    {
        $cart = $this->findInCookie();
        if ($cart) {
            return $cart;
        }
        $cart = $this->findInSession();
        if ($cart) {
            return $cart;
        }
        return null;
    }

    protected function findInCookie(): ?Cart
    {
        $cartId = $this->request->cookies->get(self::CART_REQUEST_KEY);
        if ($cartId) {
            return $this->findByUuid($cartId);
        }
        return null;
    }

    protected function findInSession(): ?Cart
    {
        if ($this->request->hasSession()) {
            $cartId = $this->request->getSession()->get(self::CART_REQUEST_KEY);
        } else {
            $cartId = $_SESSION[self::CART_REQUEST_KEY] ?? null;
        }
        if ($cartId) {
            return $this->findByUuid($cartId);
        }
        return null;
    }

    protected function findByUuid($uuid): ?Cart
    {
        return $this->getRepository()->findOneByField('uuid', $uuid);
    }

    protected function create()
    {
        $cartId = $this->generateCartId();
        $cart = $this->getRepository()->getNew();
        $cart->uuid = $cartId;
        $cart->save();

        $this->request->cookies->set(self::CART_REQUEST_KEY, $cartId);

        if ($this->request->hasSession()) {
            $this->request->getSession()->set(self::CART_REQUEST_KEY, $cartId);
        } else {
            $_SESSION[self::CART_REQUEST_KEY] = $cartId;
        }

        return $cart;
    }

    protected function generateCartId(): string
    {
        return Uuid::v4()->toString();
    }

    protected function generateRepository(): RecordManager
    {
        return BasketModels::carts();
    }
}


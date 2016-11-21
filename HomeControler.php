<?php
public class HomeController : Controller
{
public ActionResult Index()
{
ViewData["id"] = $_POST['rec_id'];
return View();
}

}

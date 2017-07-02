# -*- coding:utf-8 -*-
import sys, os
reload(sys)
sys.setdefaultencoding('utf-8')

import requests
from bs4 import BeautifulSoup


def php_proxy_request(url, form_data = {}, method = "get", cookies_str = None, user_agent = None) :
    cookies = {}
    if cookies_str is not None :
        cookies = {"Cookie": cookies_str}

    headers = {}
    if user_agent is not None :
        headers = {'User-Agent': user_agent}

    data = form_data
    data['url'] = url
    if method == "post" :
        data['method'] = 'post'

    resp = requests.get("http://localhost/proxy-simple-get.php",
                        params = form_data, cookies = cookies, headers = headers)
    return resp.text

def basic_test(url = "http://www.flyml.net/") :
    print php_proxy_request(url)


def ua_test() :
    user_agent = "php proxy ua test"

    url = "https://www.v2ex.com/ua"

    resp = php_proxy_request(url, user_agent = user_agent)

    print user_agent in resp

if __name__ == '__main__':
    ua_test()
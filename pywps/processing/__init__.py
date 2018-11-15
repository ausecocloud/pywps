##################################################################
# Copyright 2018 Open Source Geospatial Foundation and others    #
# licensed under MIT, Please consult LICENSE.txt for details     #
##################################################################

import pywps.configuration as config
# api only
from pywps.processing.basic import Processing  # noqa: F401
from pywps.processing.job import Job  # noqa: F401

import logging
LOGGER = logging.getLogger("PYWPS")


def Process(process, wps_request, wps_response):
    """
    Factory method (looking like a class) to return the
    configured processing class.

    :return: instance of :class:`pywps.processing.Processing`
    """
    mode = config.get_config_value("processing", "mode")
    process_class = config.resolve_processing_mode(mode)
    return process_class(process, wps_request, wps_response)

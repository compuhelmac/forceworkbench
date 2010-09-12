<?php
require_once 'SoapBaseClient.php';

class SforceMetadataClient extends SoapBaseClient {
	
    protected function getNamespace() {
    	return 'http://soap.sforce.com/2006/04/metadata';
    }

    protected function getServerUrl() {
    	return str_replace("/u/","/m/",$_SESSION['location']);
    }

	protected function getWsdl() {
		return "soapclient/sforce." . str_replace(".","",max($GLOBALS['API_VERSIONS'])) . ".metadata.wsdl";
	}
	
	public function describeMetadata($asOfVersion) {
		$request = new stdClass;
		$request->asOfVersion = $asOfVersion;
		return $this->sforce->__soapCall("describeMetadata",array($request))->result;
	}

	public function listMetadata($type, $folder, $asOfVersion) {
		$query = new stdClass();
		$query->type = $type;
		$query->folder = $folder;
		
		$request = new stdClass;
		$request->queries = array(new SoapVar($query, SOAP_ENC_OBJECT, 'ListMetadataQuery', $this->getNamespace()));
		$request->asOfVersion = $asOfVersion;
		
		$response = $this->sforce->__soapCall("listMetadata",array($request));
		if (isset($response->result)) {
			return $response->result;
		} else {
			return null;
		}
	}

	public function deploy($zipFile, DeployOptions $deployOptions) {
		$request = new stdClass();
		$request->ZipFile = $zipFile;
		$request->DeployOptions = $deployOptions;

		$response = $this->sforce->__soapCall("deploy",array($request));
		
		if (isset($response->result)) {
			return $response->result;
		} else {
			return null;
		}
	}

	public function retrieve(RetrieveRequest $retrieveRequest) {
		$request = new stdClass();
		$request->retrieveRequest = $retrieveRequest;

		$response = $this->sforce->__soapCall("retrieve",array($request));
		
		if (isset($response->result)) {
			return $response->result;
		} else {
			return null;
		}
	}	
	
	public function checkStatus($asyncProcessId) {
		$request = new stdClass();
		$request->asyncProcessId = array($asyncProcessId);
		
		$response = $this->sforce->__soapCall("checkStatus",array($request));

		if (isset($response->result)) {
			return $response->result;
		} else {
			return null;
		}
	}

	public function checkDeployStatus($asyncProcessId,&$outputHeaders) {
		$request = new stdClass();
		$request->asyncProcessId = $asyncProcessId;
		
		$response = $this->sforce->__soapCall("checkDeployStatus",array($request),null,null,$outputHeaders);

		if (isset($response->result)) {
			return $response->result;
		} else {
			return null;
		}
	}

	public function checkRetrieveStatus($asyncProcessId,&$outputHeaders) {
		$request = new stdClass();
		$request->asyncProcessId = $asyncProcessId;
		
		$response = $this->sforce->__soapCall("checkRetrieveStatus",array($request),null,null,$outputHeaders);

		if (isset($response->result)) {
			return $response->result;
		} else {
			return null;
		}
	}	
	
}

class DeployOptions {
     public $allowMissingFiles = false;
     public $autoUpdatePackage = false;
     public $checkOnly = false;
     public $ignoreWarnings = false;
     public $performRetrieve = false;
     public $rollbackOnError = false;
     public $singlePackage = false;
     public $runAllTests = false;
     public $runTests = array();
}


class RetrieveRequest { /* purposely leaving blank as to not force values if user doesn't provide them */ }

class Package { /* purposely leaving blank as to not force values if user doesn't provide them */ }

class PackageTypeMembers { /* purposely leaving blank as to not force values if user doesn't provide them */ }
?>